<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('order_details', function(Blueprint $table) {
			$table->string('chassis_number')->nullable();
			$table->string('vehicle_engine_number')->nullable();
			$table->longText('maintenance')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('order_details', function(Blueprint $table) {
			$table->dropColumn('chassis_number');
			$table->dropColumn('vehicle_engine_number');
			$table->dropColumn('maintenance');
		});
	}
};
