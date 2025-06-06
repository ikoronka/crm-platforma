<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('z_enrollments', function (Blueprint $table) {

            /* 1) zrušit FK, existuje-li  (dropForeign() s polem
                  funguje i kdyby FK nebyl — prostě se tiše přeskočí) */
            $table->dropForeign(['student_id']);

            /* 2) pro jistotu proper unsignedBigInteger (vyžaduje DBAL) */
            $table->unsignedBigInteger('student_id')->change();

            /* 3) nový FK s ON DELETE CASCADE */
            $table->foreign('student_id')
                ->references('id')
                ->on('z_students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('z_enrollments', function (Blueprint $table) {
            // Zpět do původního stavu – FK bez CASCADE
            $table->dropForeign(['student_id']);
            $table->foreign('student_id')
                ->references('id')
                ->on('z_students')
                ->onDelete('restrict');   // nebo ->nullOnDelete()
        });
    }
};
