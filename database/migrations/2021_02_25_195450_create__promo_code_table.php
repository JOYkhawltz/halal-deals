<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_code', function (Blueprint $table) {
            $table->bigIncrements('id');
            //customer tables
            $table->string('Pro_code', 20)->nullable();
            $table->date('Valid_from')->nullable();
            $table->date('Valid_to')->nullable();
            $table->double('Discount_applied', 10, 2)->default('0');
            $table->double('Reward_multiplier', 10, 2)->default('1');
            $table->double('Rewards_added', 10, 2)->default('0');
            $table->integer('User_Quantity')->nullable();
            $table->integer('Quantity')->nullable();

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
        Schema::dropIfExists('_promo_code');
    }
}
