<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('batch')->nullable();
            $table->string('cadet_number')->nullable();
            $table->string('address')->nullable();
            $table->string('house')->nullable();
            $table->string('tshirt_size')->nullable();
            $table->enum('marital_status', [
                \App\Models\Registration::MARITAL_STATUS_SINGLE,
                \App\Models\Registration::MARITAL_STATUS_MARRIED
            ])->nullable();
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
        Schema::dropIfExists('registrations');
    }
}
