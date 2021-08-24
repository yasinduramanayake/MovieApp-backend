<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('movie_name');
            $table->string('theater_name');
            $table->string('theater_type');
            $table->string('movie_type');
            $table->string('full_name');
            $table->string('email');
            $table->integer('seats');
            $table->double('price');
            $table->timestamp('showtime');
            $table->longText('image')->nullable();

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
        Schema::dropIfExists('bookings');
    }
}