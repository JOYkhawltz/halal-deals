<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('seos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('route', 100)->nullable();
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->string('keyword')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('seos');
    }

}
