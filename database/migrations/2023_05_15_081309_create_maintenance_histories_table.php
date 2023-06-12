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
        Schema::create('maintenance_histories', function (Blueprint $table) {
            $table->foreignId('maintenance_id')->constrained()->primary()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tool_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date');
            $table->time('time');
            $table->foreignId('responsible_technician')->constrained('staffs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('result', 255);
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
        Schema::dropIfExists('maintenance_histories');
    }
};
