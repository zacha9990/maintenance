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
        Schema::create('tool_failures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tool_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('type');
            $table->date('date');
            $table->string('action_taken');
            $table->foreign('tool_id')->references('id')->on('tools')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_failures');
    }
};
