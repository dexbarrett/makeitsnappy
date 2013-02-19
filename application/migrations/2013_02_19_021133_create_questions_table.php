<?php

class Create_Questions_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->string('question');
			$table->boolean('solved');
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions');
	}

}