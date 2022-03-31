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
        Schema::create('file_attaches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('part', ['assignment','submission','game','unknown'])->default('unknown');
            $table->unsignedInteger('partid');
            $table->longText('tenfile');
            $table->longText('url');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_attaches');
    }
};
