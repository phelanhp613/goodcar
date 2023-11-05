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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
	        $table->string('slug')->nullable();
	        $table->string('banner')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
	        $table->integer('level')->default(0);
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
	        $table->longText('meta_keyword')->nullable();
	        $table->longText('canonical')->nullable();
	        $table->longText('seo_preview')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
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
        Schema::dropIfExists('product_categories');
    }
};
