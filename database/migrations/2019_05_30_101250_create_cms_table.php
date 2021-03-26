<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cms', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            $table->enum('type', ['1', '2', '3'])->nullable()->comment('1=>Text, 2=>Image, 3=>Video');
            $table->string('slug', 100)->nullable();
            $table->string('page_name', 100)->nullable();
            $table->string('content_name', 100)->nullable();
            $table->text('content_body')->nullable();
            $table->string('instruction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cms');
    }

}
