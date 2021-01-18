<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('board_id');
            $table->integer('post_id');
            $table->index(['board_id', 'post_id'], 'board_post_index');
            $table->text('content');
            $table->string('image')->nullable();
            $table->integer('parent_id')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->string('subject')->nullable();
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
