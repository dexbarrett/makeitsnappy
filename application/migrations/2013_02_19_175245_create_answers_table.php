<?php

class Create_Answers_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('question_id');
			$table->string('answer');
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
		Schema::drop('answers');
	}

}