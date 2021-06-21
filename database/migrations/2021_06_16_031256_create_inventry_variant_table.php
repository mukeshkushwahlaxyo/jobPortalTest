<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventryVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventry_variant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('inventories_id')->unsigned();
            $table->integer('shop_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned();
            $table->string('sku', 200);
            $table->enum('condition', ['New', 'Used', 'Refurbished']);
            $table->integer('stock_quantity')->default(0);

            // $table->integer('tax_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->decimal('purchase_price', 20, 6)->nullable();
            $table->decimal('sale_price', 20, 6);
            $table->decimal('offer_price', 20, 6)->nullable();
            $table->timestamp('offer_start')->nullable();
            $table->timestamp('offer_end')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('inventories_id')->references('id')->on('inventories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventry_variant');
    }
}
