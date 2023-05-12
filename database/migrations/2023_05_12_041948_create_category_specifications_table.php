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
        Schema::create('category_specifications', function (Blueprint $table) {
            $table->bigIncrements('id');;
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('specification_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('tool_categories')->onDelete('cascade');
            $table->foreign('specification_id')->references('id')->on('tool_specifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_specifications');
    }
};
