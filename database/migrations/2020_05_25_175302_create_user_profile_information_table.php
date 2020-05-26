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
            $table->string('profile_type')->nullable();
            $table->string('title')->nullable();
            $table->string('artistic_name')->nullable();
            $table->text('about_you')->nullable();
            $table->string('genre')->nullable();
            $table->string('services')->nullable();
            $table->json('social_media')->nullable();
            $table->string('user_id');
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
        Schema::dropIfExists('user_profile_information');
    }
}
