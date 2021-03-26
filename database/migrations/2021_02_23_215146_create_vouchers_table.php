<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*tables by client*/
            $table->string('vou_ID', 20)->nullable();
            $table->string('advert_ID', 20)->nullable();
            $table->double('price', 15, 2)->nullable();
            $table->tinyinteger('quantity')->nullable();
            $table->double('total_price', 15, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->enum('redeemed', ['1', '2'])->default('2')->comment('1=>True, 2=>False');
            $table->double('cost_price', 15, 2)->nullable();
            $table->string('trans_ID', 20)->nullable();
            /*client*/

            $table->timestamps();
            
            /*
            $table->primary(['bus_ID', 'advert_ID', 'cust_ID']); 
            $table->foreign('bus_ID')->references('bus_ID')->on('businesses');
            $table->foreign('advert_ID')->references('advert_ID')->on('adverts');
            $table->foreign('cust_ID')->references('cust_ID')->on('customer');
            $table->foreign('promo_id')->references('promo_id')->on('promoCode');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
