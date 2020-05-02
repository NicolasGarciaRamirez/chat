<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_personal_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('profile_type')->default('N/A');
            $table->string('title')->default('N/A');
            $table->string('artistic_name')->default('N/A');
            $table->text('about_you')->nullable();
            $table->json('members')->nullable();
            $table->json('releases')->nullable();
            $table->string('worked_with')->nullable();
            $table->string('genre')->default('N/A');
            $table->string('services')->default('N/A');
            $table->json('social_media')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_personal_information');
    }
}
