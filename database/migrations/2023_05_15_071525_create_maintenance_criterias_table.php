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
        Schema::create('maintenance_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('tool_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // example criterias: tekanan uap stabil, dinding retak atau pecah, untuk tool lain: tidak retak, tidak bocor
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_criterias');
    }
};
