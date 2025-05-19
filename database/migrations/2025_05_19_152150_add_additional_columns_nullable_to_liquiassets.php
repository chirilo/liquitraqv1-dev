<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('liquiassets', function (Blueprint $table) {
            //
            $table->string('asset_category', 255)->nullable();
            $table->string('asset_quantity', 255)->nullable();
            $table->string('asset_type', 255)->nullable();
            $table->string('asset_make', 255)->nullable();
            $table->string('asset_model', 255)->nullable();
            $table->string('asset_serial', 255)->nullable();
            $table->string('asset_weight_each', 255)->nullable();
            $table->string('asset_description', 255)->nullable();
            $table->string('asset_status', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liquiassets', function (Blueprint $table) {
            //
            $table->dropColumn('asset_category');
            $table->dropColumn('asset_quantity');
            $table->dropColumn('asset_type');
            $table->dropColumn('asset_make');
            $table->dropColumn('asset_model');
            $table->dropColumn('asset_serial');
            $table->dropColumn('asset_weight_each');
            $table->dropColumn('asset_description');
            $table->dropColumn('asset_status');
        });
    }
};
