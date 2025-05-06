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
        Schema::table('liquijobs', function (Blueprint $table) {
            //
            $table->string('company_name', 255);
            $table->string('corporate_address', 255);
            $table->string('contact_name', 255);
            $table->string('contact_telephone', 255);
            $table->string('contact_email', 255);
            $table->string('location_address', 255);
            $table->date('start_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liquijobs', function (Blueprint $table) {
            //
            $table->dropColumn('company_name');
            $table->dropColumn('corporate_address');
            $table->dropColumn('contact_name');
            $table->dropColumn('contact_telephone');
            $table->dropColumn('contact_email');
            $table->dropColumn('location_address');
            $table->dropColumn('start_date');
        });
    }
};
