<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug');
			$table->string('position')->nullable();
			$table->longText('content')->nullable();
			$table->timestamps();
		});


		DB::table('menus')->insert([
			'name'       => 'Menu',
			'slug'       => 'menu-default',
			'position'   => '',
			'content'    => '[]',
			'created_at' => '2020-10-15 23:30:41',
			'updated_at' => '2020-10-20 22:17:19'
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('menus');
	}
};
