<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('profile_type');
            $table->string('title');
            $table->string('artistic_name')->nullable();
            $table->text('about_you')->nullable();
            $table->text('genres')->nullable();
            $table->text('services')->nullable();
            $table->json('social_media')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('user_profile_information');
    }
}
