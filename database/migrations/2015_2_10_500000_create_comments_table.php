<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
            $table->bigInteger('comment_id',true,true);
            $table->bigInteger('comment_post_id', false, true)->default(0);
            $table->string('comment_author', 255);
            $table->string('comment_author_email', 100);
            $table->string('comment_author_url', 200);
            $table->dateTime('comment_date')->default('0000-00-00 00:00:00');
            $table->dateTime('comment_date_gmt')->default('0000-00-00 00:00:00');
            $table->text('comment_content');
            $table->string('comment_approved', 20)->default(1);
            $table->bigInteger('comment_parent', false, true)->default(0);
            $table->bigInteger('user_id', false, true)->default(0);
            
            $table->index('comment_post_id', 'comment_post_id');
            $table->index('comment_author_email','comment_author_email');
            $table->index( array('comment_approved','comment_date_gmt') ,'comment_approved_date_gmt');
            $table->index('comment_date_gmt','comment_date_gmt');
            $table->index('comment_parent','comment_parent');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
