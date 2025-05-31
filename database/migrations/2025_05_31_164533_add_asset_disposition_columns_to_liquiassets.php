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

            $table->string('asset_disposition', 255)->nullable();
            $table->string('assetdisdate', 255)->nullable();
            $table->string('assetdiswho', 255)->nullable();
            $table->string('assetdisticketshippinginfo', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liquiassets', function (Blueprint $table) {
            //
            $table->dropColumn('asset_disposition');
            $table->dropColumn('assetdisdate');
            $table->dropColumn('assetdiswho');
            $table->dropColumn('assetdisticketshippinginfo');
        });
    }
};
