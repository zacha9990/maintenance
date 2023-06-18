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
            $table->unsignedBigInteger('repair_id')->nullable();
            $table->date('scheduled_date')->nullable();
            $table->string('type')->nullable()->comment("internal, or external");
            $table->string('automated_status')->nullable()->comment("automated, scheduled, or damage_report")->default('automated');
            $table->text('description')->nullable();
            $table->string('status')->nullable()->comment('cancelled', 'scheduled', 'finished');
            $table->date('assign_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('completed_date')->nullable();
            $table->time('time')->nullable();
            $table->unsignedBigInteger('responsible_technician')->nullable();
            $table->text('result')->nullable();
            $table->text('details')->nullable();
            $table->text('action_taken_internal')->nullable();
            $table->text('action_taken_external')->nullable();
            $table->timestamps();

            $table->foreign('tool_id')->references('id')->on('tools')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('repair_id')->references('id')->on('repair_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('responsible_technician')->references('id')->on('staffs')->cascadeOnDelete()->cascadeOnUpdate();
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
