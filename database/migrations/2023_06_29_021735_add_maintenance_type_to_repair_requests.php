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
        Schema::table('repair_requests', function (Blueprint $table) {
            $table->string('maintenance_type')->nullable()->after('approved')->comment('internal or external');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repair_requests', function (Blueprint $table) {
            $table->dropColumn('maintenance_type');
        });
    }
};
