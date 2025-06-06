<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Helper: drop FK if it exists (works on all drivers).
     */
    private function dropIfExists(string $table, string $column): void
    {
        $sm = Schema::getConnection()->getDoctrineSchemaManager();
        $doctrineTable = $sm->listTableDetails($table);

        foreach ($doctrineTable->getForeignKeys() as $fk) {
            if (in_array($column, $fk->getLocalColumns(), true)) {
                Schema::table($table, fn (Blueprint $t)
                => $t->dropForeign($fk->getName()));
            }
        }
    }

    public function up(): void
    {
        /* -------- z_lessons.course_id ------------- */
        $this->dropIfExists('z_lessons', 'course_id');
        Schema::table('z_lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->change();
            $table->foreign('course_id')
                ->references('id')->on('z_courses')
                ->onDelete('cascade');
        });

        /* -------- z_homework.lesson_id ------------ */
        $this->dropIfExists('z_homework', 'lesson_id');
        Schema::table('z_homework', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_id')->change();
            $table->foreign('lesson_id')
                ->references('id')->on('z_lessons')
                ->onDelete('cascade');
        });

        /* -------- z_submissions.homework_id ------- */
        $this->dropIfExists('z_submissions', 'homework_id');
        Schema::table('z_submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('homework_id')->change();
            $table->foreign('homework_id')
                ->references('id')->on('z_homework')
                ->onDelete('cascade');
        });

        /* -------- z_enrollments.course_id --------- */
        $this->dropIfExists('z_enrollments', 'course_id');
        Schema::table('z_enrollments', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->change();
            $table->foreign('course_id')
                ->references('id')->on('z_courses')
                ->onDelete('cascade');
        });

        /* -------- z_enrollments.student_id -------- */
        $this->dropIfExists('z_enrollments', 'student_id');
        Schema::table('z_enrollments', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->change();
            $table->foreign('student_id')
                ->references('id')->on('z_students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Revert all cascades back to RESTRICT
        $pairs = [
            ['z_lessons',     'course_id',   'z_courses',   'id'],
            ['z_homework',    'lesson_id',   'z_lessons',   'id'],
            ['z_submissions', 'homework_id', 'z_homework',  'id'],
            ['z_enrollments', 'course_id',   'z_courses',   'id'],
            ['z_enrollments', 'student_id',  'z_students',  'id'],
        ];

        foreach ($pairs as [$tbl, $col, $refTbl, $refCol]) {
            $this->dropIfExists($tbl, $col);
            Schema::table($tbl, function (Blueprint $table) use ($col, $refTbl, $refCol) {
                $table->foreign($col)
                    ->references($refCol)->on($refTbl)
                    ->onDelete('restrict');
            });
        }
    }
};
