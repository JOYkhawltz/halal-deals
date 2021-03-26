<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdAdvertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_advert', function (Blueprint $table) {
            $table->bigIncrements('id');
            //clients columns
            $table->string('Advert_ID',20)->nullable();
            $table->tinyInteger('Nights')->nullable();
            $table->tinyInteger('Quantity')->nullable();
            $table->tinyInteger('Size')->nullable();
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
        Schema::dropIfExists('_prod__advert');
    }
}
