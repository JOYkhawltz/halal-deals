<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            //customer columns
            $table->string('Bus_Vou_Pay_ID')->nullable();
            $table->string('Bus_ID')->nullable();
            $table->string('Method')->nullable();
            $table->date('Date')->nullable();
            $table->double('Funds_transferred')->nullable();

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
        Schema::dropIfExists('_bus_payment');
    }
}
