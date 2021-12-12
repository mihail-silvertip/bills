<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodicBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodic_bills', function (Blueprint $table) {
            $table->id();
            // user field
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            // day field
            $table->integer('day');
            // category field
            $table->string('category')->nullable();
            //description field
            $table->string('description');
            //amount field
            $table->decimal('amount', 10, 2);
            // end date field
            $table->date('end_date')->nullable();
            // payment method field
            $table->string('payment_method')->nullable();
            // observation field
            $table->string('observation')->nullable();
            $table->boolean('amount_variable')->default(false);
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
        Schema::dropIfExists('periodic_bills');
    }
}
