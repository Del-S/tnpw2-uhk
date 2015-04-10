<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->bigInteger('user_id',true,true);
            $table->string('user_login', 60)->default('');
            $table->string('user_pass', 64)->default('');
            $table->string('user_nickname', 50)->default('');
            $table->string('user_email', 100)->default('');
            $table->string('user_url', 100)->default('');
            $table->dateTime('user_registered')->default('0000-00-00 00:00:00');
            $table->string('user_activation_key', 60)->default('');
            $table->integer('user_status')->default('0');
            $table->string('display_name', 250)->default('');
            
            $table->index('user_login', 'user_login_key');
            $table->index('user_nickname','user_nickname');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
