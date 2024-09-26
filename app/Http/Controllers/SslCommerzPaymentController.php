<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Events\PaymentSucceeded;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Library\SslCommerz\SslCommerzNotification;


class SslCommerzPaymentController extends Controller
{
    public function pay(Request $request): JsonResponse
    {
        # Here you have to receive all the order data to initiate the payment.
        # Lets your oder transaction information are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        /** @var Registration $registration */
        $registration = Registration::with(['event', 'payment'])
            ->wherePhone($request->get('payment_identifier', null))
            ->firstOrFail();

        /** @var Payment $payment */
        $payment = $registration->payment;

        $post_data                 = array();
        $post_data['total_amount'] = $payment->amount; # You cant not pay less than 10
        $post_data['currency']     = "BDT";
        $post_data['tran_id']      = uniqid(); // tran_id must be unique
        $post_data['type']         = $payment->type;

        # CUSTOMER INFORMATION
        $post_data['cus_name']     = $registration->name;
        $post_data['cus_email']    = $registration->email;
        $post_data['cus_add1']     = $registration->address;
        $post_data['cus_add2']     = "";
        $post_data['cus_city']     = "";
        $post_data['cus_state']    = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country']  = "Bangladesh";
        $post_data['cus_phone']    = $registration->phone;
        $post_data['cus_fax']      = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name']     = "Store Test";
        $post_data['ship_add1']     = "Dhaka";
        $post_data['ship_add2']     = "Dhaka";
        $post_data['ship_city']     = "Dhaka";
        $post_data['ship_state']    = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone']    = "";
        $post_data['ship_country']  = "Bangladesh";

        $post_data['shipping_method']  = "NO";
        $post_data['product_name']     = $registration->event->name;
        $post_data['product_category'] = "Events";
        $post_data['product_profile']  = "events";
       // $post_data['refer']            = "5B1F9DE4D82B6"; //sandbox


        #Before  going to initiate the payment order status need to update as Pending.
        $payment->transaction_id = $post_data['tran_id'];
        $payment->currency       = $post_data['currency'];
        $payment->type           = $post_data['type'];
        $payment->save();

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $gatewayPageUrl = $sslc->makePayment($post_data, 'checkout', 'json');
        $invoice        = $sslc->invoice($post_data);

//        $payment->invoice_id = $invoice['invoice_id'] ?? null;
        $payment->save();

        return response()->json([
            'gateway_page_url' => $gatewayPageUrl,
        ]);
    }

    public function success(Request $request)
    {
        $tran_id   = $request->input('tran_id');
        $card_type = $request->input('card_type');
        $amount    = $request->input('amount');
        $currency  = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        /** @var Payment $payment */
        $payment = Payment::where('transaction_id', $tran_id)
            ->first();

        if ($payment->status == Payment::STATUS_PENDING) {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also send sms or email for successfully transaction to customer
                */

                DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'status'  => Payment::STATUS_PAID,
                        'paid_at' => Carbon::now(),
                        'type'    => $card_type,
                    ]);

                $payment->refresh();

                PaymentSucceeded::dispatch($payment);

                return view('backend.payment.success', compact('payment'));
            }
        } else {
            if ($payment->status == Payment::STATUS_PROCESSING || $payment->status == Payment::STATUS_PAID) {
                /*
                 That means through IPN Payment status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
                 */
                return view('backend.payment.success', compact('payment'));
            } else {
                #That means something wrong happened. You can redirect customer to your product page.
                return view('backend.payment.failed', compact('payment'));
            }
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $payment = Payment::where('transaction_id', $tran_id)
            ->first();

        if ($payment->status == Payment::STATUS_PENDING) {
            DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => Payment::STATUS_FAILED]);

            $payment->refresh();

            return view('backend.payment.cancel', compact('payment'));
        } else {
            if ($payment->status == Payment::STATUS_PROCESSING || $payment->status == Payment::STATUS_PAID) {
                return view('backend.payment.success', compact('payment'));
            } else {
                return view('backend.payment.failed', compact('payment'));
            }
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $payment = Payment::where('transaction_id', $tran_id)
            ->first();

        if ($payment->status == Payment::STATUS_PENDING) {
            DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => Payment::STATUS_FAILED]);

            $payment->refresh();

            return view('backend.payment.cancel', compact('payment'));
        } else {
            if ($payment->status == Payment::STATUS_PROCESSING || $payment->status == Payment::STATUS_PAID) {
                return view('backend.payment.success', compact('payment'));
            } else {
                return view('backend.payment.failed', compact('payment'));
            }
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {
            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
//            $order_details = DB::table('orders')
//                ->where('transaction_id', $tran_id)
//                ->select('transaction_id', 'status', 'currency', 'amount')->first();
//
//            if ($order_details->status == 'Pending') {
//                $sslc = new SslCommerzNotification();
//                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount,
//                    $order_details->currency);
//                if ($validation == true) {
//                    /*
//                    That means IPN worked. Here you need to update order status
//                    in order table as Processing or Complete.
//                    Here you can also sent sms or email for successful transaction to customer
//                    */
//                    $update_product = DB::table('orders')
//                        ->where('transaction_id', $tran_id)
//                        ->update(['status' => 'Processing']);
//
//                    echo "Transaction is successfully Completed";
//                }
//            } else {
//                if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
//
//                    #That means Payment status already updated. No need to udate database.
//
//                    echo "Transaction is already successfully Completed";
//                } else {
//                    #That means something wrong happened. You can redirect customer to your product page.
//
//                    echo "Invalid Transaction";
//                }
//            }
//        } else {
//            echo "Invalid Data";
        }
    }

}
