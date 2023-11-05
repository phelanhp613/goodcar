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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
			$table->string('name')->nullable();
	        $table->string('phone')->nullable();
			$table->longText('address')->nullable();
	        $table->longText('note')->nullable();
			$table->double('total_price')->default(0);
	        $table->string('payment_method')->nullable();
	        $table->boolean('status')->default(0);
	        $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
