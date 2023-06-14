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
        Schema::create('tools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('serial_number')->unique()->nullable();
            $table->text('function');
            $table->string('brand');
            $table->string('serial_type');
            $table->date('purchase_date');
            $table->text('technical_specification');
            $table->foreignId('tool_type_id')->constrained('tool_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('factory_id')->constrained('factories')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('tools');
    }
};
