<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_user', function (Blueprint $table) {
            $table->bigIncrements('_id');
            $table->unsignedBigInteger('event_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->enum('role', [
                \App\Enums\Role::EVENT_ADMIN,
                \App\Enums\Role::MANAGEMENT_ADMIN,
                \App\Enums\Role::STUDENT,
            ])->default(\App\Enums\Role::STUDENT);
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
        Schema::dropIfExists('event_user');
    }
}
