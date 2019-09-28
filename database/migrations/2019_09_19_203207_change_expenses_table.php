<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            
            $table->BigInteger('purse_id')->unsigned()->default(1);
            $table->foreign('purse_id')->references('id')->on('purses');

            $table->BigInteger('category_id')->unsigned()->default(1);
            $table->foreign('category_id')->references('id')->on('categories');
            
            $table->BigInteger('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            //
        });
    }
}
