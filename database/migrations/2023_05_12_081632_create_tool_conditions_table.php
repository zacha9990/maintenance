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
        Schema::create('tool_conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('tool_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('current_condition', 255)->nullable();
            $table->date('last_inspection_date')->nullable();
            $table->string('last_inspection_result', 255)->nullable();
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
        Schema::dropIfExists('tool_conditions');
    }
};
