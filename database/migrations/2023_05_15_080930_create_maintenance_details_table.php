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
        Schema::create('maintenance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_id')->constrained();
            $table->foreignId('tool_id')->constrained();
            $table->foreignId('category_id')->constrained('tool_categories');
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
        Schema::dropIfExists('maintenance_details');
    }
};
