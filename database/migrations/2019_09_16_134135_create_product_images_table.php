<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('product_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_name')->nullable();
            $table->string('prod_ID', 20)->nullable();
            $table->enum('is_default', ['0', '1'])->default('0')->comment('0=>Inactive, 1=>Active');
            $table->enum('status', ['0', '1', '3'])->default('1')->comment('0=>Inactive, 1=>Active, 3=>Delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('product_images');
    }

}
