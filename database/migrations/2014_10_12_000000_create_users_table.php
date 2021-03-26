<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type_id', ['1', '2', '3', '4'])->nullable()->comment('1=>Admin, 2=>Business Admin, 3=>Business Manager, 4=>Customer');
            $table->string('social_id')->nullable();
            $table->enum('account_type', ['1', '2', '3', '4'])->default('4')->comment('1=>Facebook, 2=>Google, 3=>Hotmail, 4=>Normal');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->string('phone', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('active_token')->nullable();
            $table->string('reset_token')->nullable();
            $table->rememberToken();
            $table->enum('status', ['0', '1', '2'])->default('0')->comment('0=>Inactive, 1=>Active, 2=>Block');
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
