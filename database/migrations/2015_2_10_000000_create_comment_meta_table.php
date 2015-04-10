<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment_meta', function(Blueprint $table)
		{
            $table->bigInteger('meta_id',true,true);
            $table->bigInteger('comment_id', false, true)->default(0);
            $table->string('meta_key', 255);
            $table->longtext('meta_value');
            
            $table->index('comment_id', 'comment_id');
            $table->index('meta_key','meta_key');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comment_meta');
	}

}
