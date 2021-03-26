<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('businesses', function (Blueprint $table) {
            $table->string('bus_ID', 20)->primary();
            $table->bigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('town', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('post_code', 20)->nullable();
            $table->text('prod_types')->nullable();
            $table->text('prod_sub_types')->nullable();
            $table->string('telphone_no', 50)->nullable();
            $table->text('website')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_no', 50)->nullable();
            $table->text('introduction')->nullable();
            $table->text('details')->nullable();
            $table->text('smallprint')->nullable();
            $table->tinyInteger('halal_cert')->nullable();
            $table->tinyInteger('alchohol_served')->nullable();
            $table->tinyInteger('male_service')->nullable();
            $table->tinyInteger('female_service')->nullable();
            $table->tinyInteger('gender_segregated')->nullable();
            $table->tinyInteger('family_area')->nullable();
            $table->enum('commission_type', ['1', '2'])->nullable()->comment('1=>Commission, 2=>Commission Rate');
            $table->float('commission_rate', 10, 2)->default(0);
            $table->float('additional_rate', 10, 2)->default(0);
            $table->enum('terms_and_cond_agreed', ['0', '1'])->default('0')->comment('0=>No, 1=>Yes');
            $table->string('terms_and_cond_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('businesses');
    }

}
