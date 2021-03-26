<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('adverts', function (Blueprint $table) {
            $table->string('advert_ID', 20)->primary();
            $table->string('prod_ID', 20)->nullable();
            $table->string('bus_ID', 20)->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_finish')->nullable();
            $table->date('deal_start')->nullable();
            $table->date('deal_end')->nullable();
            $table->text('smallprint')->nullable();
            $table->enum('other_options_available', ['1', '2'])->default('2')->comment('1=>Yes, 2=>No');
            $table->enum('spec_times', ['1', '2'])->default('2')->comment('1=>Yes, 2=>No');
            $table->double('spec_times_details', 10, 2)->nullable();
            $table->enum('new_cust_only', ['1', '2'])->default('2')->comment('1=>Yes, 2=>No');
            $table->enum('reservation_request_immediate', ['1', '2'])->default('2')->comment('1=>Yes, 2=>No');
            $table->double('cost_price', 15, 2)->nullable();
            $table->double('hd_price', 15, 2)->nullable();
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
        Schema::dropIfExists('adverts');
    }

}
