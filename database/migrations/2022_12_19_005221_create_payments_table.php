<?php

use App\Models\Payment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('registration_id');
            $table->float('amount')->nullable();
            $table->float('quantity')->nullable();
            $table->enum('status', [
                Payment::STATUS_PENDING,
                Payment::STATUS_PAID,
                Payment::STATUS_FAILED,
                Payment::STATUS_PROCESSING,
                Payment::STATUS_REFUND,
                Payment::STATUS_EXTRA_AMOUNT,
                Payment::STATUS_MANUAL,
            ])->default(Payment::STATUS_PENDING);
            $table->string('type')->nullable();
            $table->string('transaction_id');
            $table->string('invoice_id')->nullable();
            $table->string('currency');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
