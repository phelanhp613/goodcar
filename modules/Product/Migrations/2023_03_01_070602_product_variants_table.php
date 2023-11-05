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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
	        $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->longText('images')->nullable();
            $table->integer('stock')->default(0);
            $table->double('price')->default(0);
            $table->double('discount')->default(0);
	        $table->boolean('is_root')->default(0);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('created_by')->default(1);
            $table->unsignedBigInteger('updated_by')->default(1);
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
        Schema::dropIfExists('product_variants');
    }
};
