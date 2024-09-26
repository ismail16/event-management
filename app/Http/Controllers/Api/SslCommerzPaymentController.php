<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Log;

class SslCommerzPaymentController extends Controller
{
    public function pay(Request $request): JsonResponse
    {
        try {
            # Here you have to receive all the order data to initiate the payment.
            # Lets your oder transaction information are saving in a table called "orders"
            # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
            /** @var Registration $registration */
            $registration = Registration::with(['event', 'payment'])
                ->wherePhone($request->get('payment_identifier', null))
                ->latest('id')
                ->first();

            /** @var Payment $payment */
            $payment = $registration->payment;

            $post_data = array();
            $post_data['total_amount'] = $payment->amount; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = uniqid(); // tran_id must be unique
            $post_data['type'] = $payment->type;

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $registration->name;
            $post_data['cus_email'] = $registration->email;
            $post_data['cus_add1'] = $registration->address;
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $registration->phone;
            $post_data['cus_fax'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "Bangladesh";

            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = data_get($registration, 'event.name');
            $post_data['product_category'] = "Events";
            $post_data['product_profile'] = "events";

            if (env('SSLCZ_TESTMODE') === true) {
                $post_data['refer'] = "5B1F9DE4D82B6"; //sandbox
            }


            #Before  going to initiate the payment order status need to update as Pending.
            $payment->transaction_id = $post_data['tran_id'];
            $payment->currency = $post_data['currency'];
            $payment->type = $post_data['type'];
            $payment->save();

            $sslc = new SslCommerzNotification();
            $response = $sslc->makePayment($post_data, 'checkout', 'json');


            Log::info("ssl commerce response", [$response]);
            $gatewayPageUrl = $response['GatewayPageURL'] ?? null;
            return response()->json([
                'gateway_page_url' => $gatewayPageUrl,
            ]);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
//            throw new \Exception("Payment URL generation failed.");
        }
    }


}
