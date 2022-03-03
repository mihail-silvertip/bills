<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Account;
use App\Models\BankAccount;


class BillsAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add account_id to bills
        Schema::table('bills', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('user_id');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        //add account_id to periodic_bills
        Schema::table('periodic_bills', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('user_id');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        // create a default bank account and account for each user
        $users = User::all();
        foreach ($users as $user) {
            $bankAccount = new BankAccount();
            $bankAccount->user_id = $user->id;
            $bankAccount->name = 'Default Bank Account';
            $bankAccount->save();

            $account = new Account();
            $account->user_id = $user->id;
            $account->name = 'Default Account';
            $account->bank_account_id = $bankAccount->id;
            $account->save();

            // add account_id to bills
            $bills = $user->bills;
            foreach ($bills ?? [] as $bill) {
                $bill->account_id = $account->id;
                $bill->save();
            }

            // add account_id to periodic_bills
            $periodicBills = $user->periodicBills;
            foreach ($periodicBills ?? [] as $periodicBill) {
                $periodicBill->account_id = $account->id;
                $periodicBill->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
