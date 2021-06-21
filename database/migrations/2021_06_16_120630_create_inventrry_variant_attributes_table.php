<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventrryVariantAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_variant_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('attributeValue_id')->unsigned();
            $table->bigInteger('variant_id')->unsigned();
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('attributeValue_id')->references('id')->on('attribute_values')->onDelete('cascade');
            $table->foreign('variant_id')->references('id')->on('inventry_variant')->onDelete('cascade');
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
        Schema::dropIfExists('inventrry_variant_attributes');
    }
}
