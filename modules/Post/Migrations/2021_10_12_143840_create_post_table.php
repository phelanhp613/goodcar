<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post', function (Blueprint $table) {
			$table->id();
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->longText('description')->nullable();
			$table->longText('post_category')->nullable();
			$table->longText('content')->nullable();
			$table->longText('images')->nullable();
			$table->boolean('status')->default(1);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('post');
	}
};
