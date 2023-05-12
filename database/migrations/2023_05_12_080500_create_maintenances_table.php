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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tool_id');
            $table->unsignedBigInteger('repair_id');
            $table->string('type');
            $table->date('asign_date');
            $table->date('completed_date');
            $table->time('time');
            $table->unsignedBigInteger('responsible_technician');
            $table->text('result');
            $table->text('details');
            $table->string('action_taken_internal');
            $table->string('action_taken_external');
            $table->timestamps();

            $table->foreign('tool_id')->references('id')->on('tools');
            $table->foreign('repair_id')->references('id')->on('repair_requests');
            $table->foreign('responsible_technician')->references('id')->on('staffs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenances');
    }
};
