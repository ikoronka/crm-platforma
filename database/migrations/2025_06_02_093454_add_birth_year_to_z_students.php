<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('z_students', function (Blueprint $t) {
        $t->unsignedSmallInteger('birth_year');   // např. 2010
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('z_students', function (Blueprint $table) {
            //
        });
    }
};
