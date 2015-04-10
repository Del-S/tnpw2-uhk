<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category', function(Blueprint $table)
		{
            $table->bigInteger('category_id',true,true);
            $table->string('category_name', 200)->default('');
            $table->text('category_title');
            $table->text('category_excerpt');           
            $table->longtext('category_content');
            $table->bigInteger('category_parent', false, true)->default(0);
            $table->string('guid', 255)->default('');
            $table->integer('menu_order')->default(0);
            
            $table->index('category_name', 'category_name');
            $table->index('category_parent','category_parent');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category');
	}

}
