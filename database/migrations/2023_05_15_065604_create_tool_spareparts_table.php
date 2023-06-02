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
        Schema::create('tool_spareparts', function (Blueprint $table) {
            $table->foreignId('tool_id')->constrained();
            $table->foreignId('sparepart_id')->constrained();
            $table->primary(['tool_id', 'sparepart_id']);
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
        Schema::dropIfExists('tool_spareparts');
    }
};
