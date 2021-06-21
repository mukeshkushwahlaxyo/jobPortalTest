<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventryCustomiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_customise', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('inventories_id')->unsigned();
            $table->bigInteger('attrValue_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->bigInteger('attributeSublist_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('attrValue_id')->references('id')->on('inventory_customise')->onDelete('cascade');
            $table->foreign('attributeSublist_id')->references('id')->on('attribute_sublist')->onDelete('cascade');
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
        Schema::dropIfExists('inventory_customise');
    }
}
