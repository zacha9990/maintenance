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
        Schema::create('tool_specifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('tool_id')->constrained()->onDelete('cascade');
            $table->foreignId('spec_id')->constrained('category_specifications')->onDelete('cascade');
            $table->string('specification_key');
            $table->string('unit');
            $table->text('specification_value')->nullable();
            $table->timestamps();
        });
    }

    // misalnya nama tool pump, spesifikasi, kode serial number, merk, dll

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_specifications');
    }
};
