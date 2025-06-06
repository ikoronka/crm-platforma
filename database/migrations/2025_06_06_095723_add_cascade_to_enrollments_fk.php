<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Najdeme aktuální název FK (pokud existuje)
        $fkName = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME',  'z_enrollments')
            ->where('COLUMN_NAME', 'student_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->value('CONSTRAINT_NAME');        // null → žádný FK

        // 2) Starý FK (bez CASCADE) zrušíme
        if ($fkName) {
            DB::statement("ALTER TABLE z_enrollments DROP FOREIGN KEY `$fkName`");
        }

        // 3) Vytvoříme nový FK s ON DELETE CASCADE
        Schema::table('z_enrollments', function (Blueprint $table) {
            $table->foreign('student_id')
                ->references('id')
                ->on('z_students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // 1) Najdeme FK zavedený v up()
        $fkName = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME',  'z_enrollments')
            ->where('COLUMN_NAME', 'student_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->value('CONSTRAINT_NAME');

        // 2) Zrušíme
        if ($fkName) {
            DB::statement("ALTER TABLE z_enrollments DROP FOREIGN KEY `$fkName`");
        }

        // 3) (volitelné) Přidáme zpět FK bez CASCADE
        Schema::table('z_enrollments', function (Blueprint $table) {
            $table->foreign('student_id')
                ->references('id')
                ->on('z_students')
                ->onDelete('restrict');   // nebo ->nullOnDelete() dle libosti
        });
    }
};
