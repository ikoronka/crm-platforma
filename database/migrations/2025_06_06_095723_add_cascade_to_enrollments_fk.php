<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /* přidá ON DELETE CASCADE na student_id */
    public function up(): void
    {
        Schema::table('z_enrollments', function (Blueprint $table) {

            // zruštíme FK, jestli existuje – v SQLite to klidně tiše neudělá nic
            $table->dropForeign(['student_id']);

            // změna typu je nutná jen v MySQL – díky DBAL funguje i v SQLite
            $table->unsignedBigInteger('student_id')->change();

            // nový FK s cascade
            $table->foreign('student_id')
                ->references('id')
                ->on('z_students')
                ->onDelete('cascade');
        });
    }

    /* revert: vrátí FK bez cascade (restrict) */
    public function down(): void
    {
        Schema::table('z_enrollments', function (Blueprint $table) {
            $table->dropForeign(['student_id']);

            $table->foreign('student_id')
                ->references('id')
                ->on('z_students')
                ->onDelete('restrict');
        });
    }
};
