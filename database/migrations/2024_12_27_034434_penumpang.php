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
        Schema::create('penumpang', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('kode_booking', 255);
            $table->string('nama', 255);
            $table->string('kota', 255);
            $table->string('pickup_location', 255);
            $table->string('no_telp');
            $table->integer('usia');
            $table->integer('tahun_lahir');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('penumpang');
    }
};
