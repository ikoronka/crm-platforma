<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ---------- 1) sloupec course_id, pokud by chyběl ----------
        Schema::table('z_lessons', function (Blueprint $table) {
            if (! Schema::hasColumn('z_lessons', 'course_id')) {
                $table->unsignedBigInteger('course_id')->after('id');
            }
        });

        // ---------- 2) je na course_id už nějaký FK? ----------
        $fkName = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', 'z_lessons')
            ->where('COLUMN_NAME', 'course_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->value('CONSTRAINT_NAME');     // null = žádný FK

        // pokud existuje a jmenuje se JINAK, raději ho smažeme ručně
        if ($fkName) {
            DB::statement("ALTER TABLE z_lessons DROP FOREIGN KEY `$fkName`");
        }

        // ---------- 3) vytvoříme FK s CASCADE ----------
        Schema::table('z_lessons', function (Blueprint $table) {
            $table->foreign('course_id')
                ->references('id')
                ->on('z_courses')
                ->onDelete('cascade');
        });

        // ---------- 4) UNIQUE na pořadí lekcí v rámci kurzu ----------
        if (Schema::hasColumn('z_lessons', 'order_number')) {
            Schema::table('z_lessons', function (Blueprint $table) {
                $table->unique(
                    ['course_id', 'order_number'],
                    'z_lessons_course_order_unique'
                );
            });
        }
    }

    public function down(): void
    {
        // zrušíme UNIQUE
        Schema::table('z_lessons', function (Blueprint $table) {
            $table->dropUnique('z_lessons_course_order_unique');
        });

        // zrušíme FK (pokud existuje)
        $fkName = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', 'z_lessons')
            ->where('COLUMN_NAME', 'course_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->value('CONSTRAINT_NAME');

        if ($fkName) {
            DB::statement("ALTER TABLE z_lessons DROP FOREIGN KEY `$fkName`");
        }
    }
};
