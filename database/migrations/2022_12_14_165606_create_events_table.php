<?php

use App\Models\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('venue');
            $table->string('email');
            $table->string('phone');
            $table->timestamp('event_start_date');
            $table->timestamp('event_end_date');
            $table->timestamp('reg_start_date');
            $table->timestamp('reg_end_date');
            $table->enum('event_type', [
                Event::EVENT_TYPE_PUBLIC,
                Event::EVENT_TYPE_PRIVATE,
                Event::EVENT_TYPE_MEMBER
            ])->default(Event::EVENT_TYPE_PUBLIC);
            $table->string('organization');
            $table->enum('subscription_fee_type', [
                Event::SUBSCRIPTION_FEE_TYPE_FREE,
                Event::SUBSCRIPTION_FEE_TYPE_FLAT_PRICE,
                Event::SUBSCRIPTION_FEE_TYPE_PACKAGE
            ])->default(Event::SUBSCRIPTION_FEE_TYPE_FREE);
            $table->float('subscription_fee')->default(0);
            $table->decimal('max_participant');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_registration_allowed')->default(false);
            $table->string('contact');
            $table->string('map_url')->nullable();
            $table->string('social_url')->nullable();
            $table->string('faq_url')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
