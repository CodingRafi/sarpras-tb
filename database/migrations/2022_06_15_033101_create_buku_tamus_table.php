<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku_tamus', function (Blueprint $table) {
            $table->id();
            $table->String('nama');
            $table->String('instansi');
            $table->text('alamat');
            $table->enum('kategori', ['khusus', 'umum']);
            $table->text('image');
            $table->text('signed');
            $table->foreignId('guru_id')->contrained('m_gurus');
            $table->text('keperluan');
            $table->text('no_telp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku_tamus');
    }
};
