<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('disposisis', function (Blueprint $table) {
            $table->dropColumn('keputusan');
            $table->dropColumn('hasil');
            $table->dropColumn('tindakan');
            $table->dropColumn('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disposisis', function (Blueprint $table) {
            $table->string('keputusan'); 
            $table->string('hasil');
            $table->string('tindakan'); 
            $table->string('keterangan');  // Mengembalikan kolom yang dihapus saat rollback

        });
    }
};
