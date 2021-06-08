<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeFieldsFormMarchentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->integer('price')->nullable();
            $table->string('quality')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('status')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
             $table->integer('price')->nullable();
            $table->string('quality')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('status')->nullable();
            $table->text('description')->nullable();
        });
    }
}
