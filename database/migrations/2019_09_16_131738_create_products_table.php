<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->string('prod_ID', 20)->primary();
            $table->string('bus_ID', 20)->nullable();
            $table->string('name')->nullable();
            $table->text('brief_description')->nullable();
            $table->text('detailed_description')->nullable();
            $table->text('smallprint')->nullable();
            $table->double('normal_price', 15, 2)->nullable();
            $table->text('actual_deal')->nullable();
            $table->enum('price_verified', ['1', '2'])->default('2')->comment('1=>Yes, 2=>No');
            $table->date('price_verified_date')->nullable();
            $table->enum('address_required', ['1', '2'])->default('2')->comment('1=>Yes, 2=>No');
            $table->double('postage_cost', 15, 2)->nullable()->comment('The additional cost of postage of the product. This will be added to the advert and the customer’s payment. This will not be charged commission.');
            $table->enum('status', ['0', '1', '3'])->default('0')->comment('0=>Inactive, 1=>Active, 3=>Delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('products');
    }

}
