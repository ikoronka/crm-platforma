<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* ---------- z_lessons.course_id ------------- */
        Schema::table('z_lessons', function (Blueprint $t) {
            // 1) zruš existující FK (Laravel si jméno spočítá sám)
            $t->dropForeign(['course_id']);
        });

        Schema::table('z_lessons', function (Blueprint $t) {
            // 2) znovu ho přidej s CASCADE
            $t->foreign('course_id')
                ->references('id')->on('z_courses')
                ->cascadeOnDelete();
        });

        /* --------- z_homework.lesson_id -------------- */
        Schema::table('z_homework', function (Blueprint $t) {
            $t->dropForeign(['lesson_id']);
        });
        Schema::table('z_homework', function (Blueprint $t) {
            $t->foreign('lesson_id')
                ->references('id')->on('z_lessons')
                ->cascadeOnDelete();
        });

        /* --------- z_submissions.homework_id --------- */
        Schema::table('z_submissions', function (Blueprint $t) {
            $t->dropForeign(['homework_id']);
        });
        Schema::table('z_submissions', function (Blueprint $t) {
            $t->foreign('homework_id')
                ->references('id')->on('z_homework')
                ->cascadeOnDelete();
        });

        /* --------- z_enrollments.course_id ----------- */
        Schema::table('z_enrollments', function (Blueprint $t) {
            $t->dropForeign(['course_id']);
        });
        Schema::table('z_enrollments', function (Blueprint $t) {
            $t->foreign('course_id')
                ->references('id')->on('z_courses')
                ->cascadeOnDelete();
        });

        /* --------- z_enrollments.student_id ---------- */
        Schema::table('z_enrollments', function (Blueprint $t) {
            $t->dropForeign(['student_id']);
        });
        Schema::table('z_enrollments', function (Blueprint $t) {
            $t->foreign('student_id')
                ->references('id')->on('z_students')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        // vrátí CA SC AD E na RESTRICT – princip stejný
        $pairs = [
            ['z_lessons',     'course_id',   'z_courses'],
            ['z_homework',    'lesson_id',   'z_lessons'],
            ['z_submissions', 'homework_id', 'z_homework'],
            ['z_enrollments', 'course_id',   'z_courses'],
            ['z_enrollments', 'student_id',  'z_students'],
        ];

        foreach ($pairs as [$table, $col, $ref]) {
            Schema::table($table, function (Blueprint $t) use ($col) {
                $t->dropForeign([$col]);
            });
            Schema::table($table, function (Blueprint $t) use ($col, $ref) {
                $t->foreign($col)
                    ->references('id')->on($ref)
                    ->restrictOnDelete();           // nebo ->nullOnDelete()
            });
        }
    }
};
