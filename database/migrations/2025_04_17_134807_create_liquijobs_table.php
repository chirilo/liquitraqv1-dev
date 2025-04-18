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
            $table->integer('so_number')->unsigned();
            $table->string('building', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->string('status', 255);
            $table->integer('expected_qty')->unsigned();
            $table->integer('serial_number')->unsigned();
            $table->string('hid_employee_name', 255);
            $table->integer('hid_employee_id')->unsigned();
            $table->date('liquis_pickup_date');
            $table->string('liquis_employee_name', 255);
            $table->integer('invoice_number')->unsigned();
            $table->mediumText('liquis_complete_photo')->charset('binary');
            $table->mediumText('additional_images')->charset('binary');
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
