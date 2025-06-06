<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /* odebrat sloupec */
    public function up(): void
    {
        Schema::table('z_lessons', function (Blueprint $table) {
            if (Schema::hasColumn('z_lessons', 'lesson_date')) {
                $table->dropColumn('lesson_date');
            }
        });
    }

    /* vrátit zpět (nullable date) */
    public function down(): void
    {
        Schema::table('z_lessons', function (Blueprint $table) {
            if (!Schema::hasColumn('z_lessons', 'lesson_date')) {
                $table->date('lesson_date')->nullable()->after('description');
            }
        });
    }
};
