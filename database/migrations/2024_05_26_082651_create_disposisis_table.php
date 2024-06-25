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
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')
                    ->constrained('surats')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            $table->text('disposisi');
            $table->text('keputusan');
            $table->text('hasil');
            $table->text('tindakan');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};
