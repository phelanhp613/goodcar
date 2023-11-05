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
	public function up(){
		Schema::create('products', function (Blueprint $table){
			$table->id();
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->string('sku')->nullable();
			$table->longText('description')->nullable();
			$table->longText('content')->nullable();
			$table->longText('promotion')->nullable();
			$table->longText('images')->nullable();
			$table->boolean('status')->default(1);
			$table->boolean('has_variant')->default(0);
			$table->unsignedBigInteger('product_category_id');
			$table->longText('product_category_ids');
			$table->longText('attribute_ids')->nullable();
			$table->string('meta_title')->nullable();
			$table->longText('meta_description')->nullable();
			$table->longText('meta_keyword')->nullable();
			$table->longText('canonical')->nullable();
			$table->longText('seo_preview')->nullable();
			$table->unsignedBigInteger('created_by');
			$table->unsignedBigInteger('updated_by');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('products');
	}
};
