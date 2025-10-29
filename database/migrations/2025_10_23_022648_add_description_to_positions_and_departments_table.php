<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('nama_departemen');
        });

        Schema::table('positions', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('gaji_pokok');
        });
    }

    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });

        Schema::table('positions', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};