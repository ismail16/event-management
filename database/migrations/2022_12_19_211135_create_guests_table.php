<?php

use App\Models\Registration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('registration_id');
            $table->string('name')->nullable();
            $table->string('age')->nullable();
            $table->float('amount')->nullable();
            $table->float('quantity')->nullable();
            $table->enum('type',[
                Registration::TYPE_GUEST_COUPLE,
                Registration::TYPE_GUEST_KID_ABOVE,
                Registration::TYPE_GUEST_KID_BELOW,
                Registration::TYPE_GUEST_DRIVER,
                Registration::TYPE_GUEST_MAID,
                Registration::TYPE_GUEST_OTHER,
                Registration::TYPE_GUEST_SINGLE,
                Registration::TYPE_GUEST_GENERAL,
                Registration::TYPE_GUEST_STUDENT,
            ])->default(Registration::TYPE_GUEST_OTHER);
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
        Schema::dropIfExists('guests');
    }
}
