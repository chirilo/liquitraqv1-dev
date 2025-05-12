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
        Schema::create('liquiassets', function (Blueprint $table) {
            $table->id();
            //$table->mediumText('job_asset')->charset('binary')->nullable();
            $table->string('job_asset')->nullable();
            $table->string('job_id', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquiassets');
    }
};
