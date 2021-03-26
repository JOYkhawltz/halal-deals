<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 100)->nullable();
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->set('type', ['text', 'textarea', 'password', 'select', 'select-multiple', 'radio', 'checkbox', 'file'])->nullable();
            $table->text('default')->nullable();
            $table->text('value')->nullable();
            $table->text('options')->nullable();
            $table->tinyInteger('is_required')->nullable();
            $table->tinyInteger('is_gui')->nullable();
            $table->string('module', 50)->nullable();
            $table->integer('row_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('settings');
    }

}
