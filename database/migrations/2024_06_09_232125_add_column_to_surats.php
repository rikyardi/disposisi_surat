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
        Schema::table('surats', function (Blueprint $table) {
            $table->string('keputusan')->nullable()->after('keterangan');
            $table->string('hasil')->nullable()->after('keputusan');
            $table->string('tindakan')->nullable()->after('hasil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->dropColumn('keputusan');
            $table->dropColumn('hasil');
            $table->dropColumn('tindakan');
        });
    }
};
