<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorrectTopupBalanceToAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('topups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('useraccount_id')->unsigned();
            $table->decimal('amount')->default('0');
            $table->foreign('useraccount_id')->references('id')->on('user_accounts');
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
        //
         Schema::dropIfExists('topups');

    }
}
