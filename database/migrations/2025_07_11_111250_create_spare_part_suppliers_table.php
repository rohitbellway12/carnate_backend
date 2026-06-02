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
        Schema::create('spare_part_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_no');
            $table->string('business_first_name');
            $table->text('business_address')->nullable();
            $table->string('gstin')->nullable();
            $table->string('owner_first_name');
            $table->string('contact_1');
            $table->string('contact_2')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spare_part_suppliers');
    }
};
