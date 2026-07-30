<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('spare_part_suppliers', function (Blueprint $table) {
            $table->decimal('balance', 15, 2)->nullable()->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('spare_part_suppliers', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
};
