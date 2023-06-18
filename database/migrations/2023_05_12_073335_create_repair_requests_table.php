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
        Schema::create('repair_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('staff_id')->constrained('staffs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tool_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('description');
            $table->string('status')->nullable()->index()->comment('reported, working, finished, cancelled');
            $table->boolean('approved')->default(false);
            $table->dateTime('approved_at')->nullable();
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
        Schema::dropIfExists('repair_requests');
    }
};
