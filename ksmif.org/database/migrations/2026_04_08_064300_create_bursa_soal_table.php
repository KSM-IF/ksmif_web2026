<?php

use App\Models\User;
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
        Schema::create('matkul', function (Blueprint $table){
            $table->string('id', 8)->primary();
            $table->string('nama_matkul', 50);
            $table->timestamps();
        });    

        Schema::create('bursa_soal', function (Blueprint $table) {
            $table->id();
            $table->string('matkul_id', 8);
            $table->string('nama_file');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->string('tahun');
            $table->enum('tipe',['UTS', 'UAS', 'Quiz', 'Latihan']);
            $table->string('path');
            $table->timestamps();

            $table->foreign('matkul_id')
                  ->references('id') 
                  ->on('matkul')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bursa_soal');
    }
};
