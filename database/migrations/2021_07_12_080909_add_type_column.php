<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('type');
            $table->tinyInteger('is_group');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('type');            
            $table->tinyInteger('is_group');            
        });
    }
}
