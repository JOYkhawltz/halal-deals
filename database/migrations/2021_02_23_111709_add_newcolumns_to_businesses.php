<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewcolumnsToBusinesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            //
            $table->string('Email_address')->nullable();
            $table->string('Title')->nullable();
            $table->string('Surname')->nullable();
            $table->string('Yt_link')->nullable();
            $table->string('HD_Staff_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            //
            $table->dropColumn(['Email_address']);
            $table->dropColumn(['Title']);
            $table->dropColumn(['Surname']);
            $table->dropColumn(['Yt_link']);
            $table->dropColumn(['HD_Staff_link']);
        });
    }
}
