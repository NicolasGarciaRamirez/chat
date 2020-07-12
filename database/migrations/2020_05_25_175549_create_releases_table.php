<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('album_name');
            $table->string('artistic_name')->nullable();
            $table->string('genre');
            $table->string('image');
            $table->string('label');
            $table->string('release_date');
            $table->unsignedBigInteger('profile_information_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('profile_information_id')->references('id')->on('user_profile_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('releases');
    }
}
