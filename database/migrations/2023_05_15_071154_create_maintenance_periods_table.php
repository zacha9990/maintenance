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
        Schema::create('maintenance_periods', function (Blueprint $table) {
            $table->foreignId('tool_id')->constrained();
            $table->integer('maintenance_period');
            $table->string('maintenance_type', 255)->comment('weekly, monthly, or yearly');

            $table->primary('tool_id');

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
        Schema::dropIfExists('maintenance_periods');
    }
};
