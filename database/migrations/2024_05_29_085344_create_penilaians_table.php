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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id("penilaian_id");
            $table->foreignId("alternatif_id")->references("alternatif_id")->on("alternatifs")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId("kriteria_id")->references("kriteria_id")->on("kriterias")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId("sub_kriteria_id")->nullable()->references("sub_kriteria_id")->on("sub_kriterias")->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
