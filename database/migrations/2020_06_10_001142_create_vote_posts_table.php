<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_vote');
            $table->unsignedBigInteger('posts_id');
            $table->unsignedBigInteger('voteable_id');
            $table->string('voteable_type');
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
        Schema::dropIfExists('vote_posts');
    }
}
