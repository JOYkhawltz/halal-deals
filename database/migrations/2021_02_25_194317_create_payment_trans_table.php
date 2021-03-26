<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_trans', function (Blueprint $table) {
            $table->bigIncrements('Trans_ID');
            $table->string('Pay_Trans_ID', 20)->nullable();
            $table->string('Method', 20)->nullable();
            $table->date('Pay_date')->nullable();
            $table->double('Total', 15, 2)->nullable();
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
        Schema::dropIfExists('payment_trans');
    }
}
