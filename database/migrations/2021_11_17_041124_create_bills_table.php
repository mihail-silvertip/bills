<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            // due_date field
            $table->date('due_date');
            // category field
            $table->string('category');
            //description field
            $table->string('description');
            //amount field
            $table->decimal('amount', 10, 2);
            // observation field
            $table->string('observation')->nullable();
            // payment method field
            $table->string('payment_method');
            // periodic bill id field
            $table->unsignedBigInteger('periodic_bill_id')->nullable();
            $table->foreign('periodic_bill_id')->references('id')->on('periodic_bills');
            // confirmed_date field
            $table->date('confirmed_date')->nullable();
            // paid_date field
            $table->date('paid_date')->nullable();


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
        Schema::dropIfExists('bills');
    }
}
