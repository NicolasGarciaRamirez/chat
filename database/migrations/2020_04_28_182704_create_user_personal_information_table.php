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
            $table->integer('user_id');
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
        Schema::dropIfExists('user_personal_information');
    }
}
