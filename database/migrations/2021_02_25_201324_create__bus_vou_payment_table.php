<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusVouPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_vou_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            //customer columns
            $table->string('Bus_Vou_Pay_ID')->nullable();
            $table->string('Voucher_ID')->nullable();
            $table->date('Date_Req')->nullable();

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
        Schema::dropIfExists('_bus_vou_payment');
    }
}
