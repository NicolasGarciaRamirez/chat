<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('subscription_type')->default('FREE');
            $table->string('token', 80)->nullable();
            $table->string('avatar')->default('/images/profile/default.svg');
            $table->string('cover')->default('/images/profile/default-cover.svg');
            $table->boolean('enable')->default(true);
            $table->boolean('validated')->default(false);
            $table->boolean('banned')->default(false);
            $table->timestamp('verification_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
