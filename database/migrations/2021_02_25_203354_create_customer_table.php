<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            //customer columns
            $table->string('Cust_ID', 20)->nullable();
            $table->string('email_address', 80)->nullable();
            $table->string('Title', 20)->nullable();
            $table->string('Forename', 20)->nullable();
            $table->string('Surname', 20)->nullable();
            $table->tinyInteger('Tel_no')->nullable();
            $table->date('DOB')->nullable();
            $table->enum('Email_pref', ['0', '1'])->default('0')->comment('0=>No, 1=>Yes');
            $table->enum('Phone_pref', ['0', '1'])->default('0')->comment('0=>No, 1=>Yes');
            $table->string('main_area', 50)->nullable();
            $table->double('Discount_rate')->nullable();
            $table->double('Reward_points', 10 ,2)->nullable();
            $table->date('GRPR_Agreed_date')->nullable();

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
        Schema::dropIfExists('customer');
    }
}
