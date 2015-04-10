<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_meta', function(Blueprint $table)
		{
            $table->bigInteger('meta_id',true,true);
            $table->bigInteger('user_id', false, true)->default(0);
            $table->string('meta_key', 255);
            $table->longtext('meta_value');
            
            $table->index('user_id', 'user_id');
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
		Schema::drop('user_meta');
	}

}
