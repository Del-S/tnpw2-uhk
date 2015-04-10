<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
            $table->bigInteger('post_id',true,true);
            $table->bigInteger('post_author', false, true)->default(0);
            $table->dateTime('post_date')->default('0000-00-00 00:00:00');
            $table->dateTime('post_date_gmt')->default('0000-00-00 00:00:00');
            $table->longtext('post_content');
            $table->text('post_title');
            $table->text('post_excerpt');
            $table->string('post_status', 20)->default('publish');
            $table->string('comment_status', 20)->default('open');
            $table->string('post_name', 200)->default('');
            $table->bigInteger('post_parent', false, true)->default(0);
            $table->string('guid', 255)->default('');
            $table->integer('menu_order')->default(0);
            $table->string('post_type', 20)->default('post');
            $table->bigInteger('comment_count')->default(0);
            
            $table->index('post_name', 'post_name');
            $table->index( array('post_type', 'post_status', 'post_date', 'post_id') ,'type_status_date');        
            $table->index('post_parent','post_parent');
            $table->index('post_author','post_author');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
