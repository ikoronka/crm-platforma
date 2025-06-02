<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('z_students', function (Blueprint $t) {
        $t->string('profile_picture')->nullable()->change();
        // nebo ->default(null)->change(); ale nullable je běžnější
    });
}

public function down(): void
{
    Schema::table('z_students', function (Blueprint $t) {
        $t->string('profile_picture')->nullable(false)->change();
    });
}

};
