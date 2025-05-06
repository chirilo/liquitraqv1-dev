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
        Schema::create('liquijobs', function (Blueprint $table) {
            $table->id();
            $table->integer('so_number')->unsigned()->nullable();
            $table->string('building', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->integer('expected_qty')->unsigned()->nullable();
            $table->integer('serial_number')->unsigned()->nullable();
            $table->string('hid_employee_name', 255)->nullable();
            $table->integer('hid_employee_id')->unsigned()->nullable();
            $table->date('liquis_pickup_date')->nullable();
            $table->string('liquis_employee_name', 255)->nullable();
            $table->integer('invoice_number')->unsigned()->nullable();
            $table->mediumText('liquis_complete_photo')->charset('binary')->nullable();
            $table->mediumText('additional_images')->charset('binary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquijobs');
    }
};
