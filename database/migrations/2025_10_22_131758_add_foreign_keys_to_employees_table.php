<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
        $table->unsignedBigInteger('departemen_id')->after('tanggal_masuk')->nullable();
        $table->unsignedBigInteger('jabatan_id')->after('departemen_id')->nullable();

        $table->foreign('departemen_id')->references('id')->on('departments')->onDelete('set null');
        $table->foreign('jabatan_id')->references('id')->on('positions')->onDelete('set null');
    });
 
    }
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
        $table->dropForeign(['departemen_id']);
        $table->dropForeign(['jabatan_id']);
        $table->dropColumn(['departemen_id', 'jabatan_id']);
        });
    }
};
