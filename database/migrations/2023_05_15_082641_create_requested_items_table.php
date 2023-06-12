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
        Schema::create('requested_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_request_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->tinyInteger('type')->comment('1: sparepart, 2: tool');
            $table->foreignId('tool_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('sparepart_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('quantity')->default(1);
            $table->text('description')->nullable();

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
        Schema::dropIfExists('requested_items');
    }
};
