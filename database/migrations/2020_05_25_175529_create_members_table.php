<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_name');
            $table->string('member_type');
            $table->string('link_profile')->nullable();
            $table->string('role_instrument');
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
        Schema::dropIfExists('members');
    }
}
