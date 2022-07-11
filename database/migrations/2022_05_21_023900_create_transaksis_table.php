<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 6)->unique();
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('koleksi_id')->nullable()->constrained('koleksi')->onUpdate('cascade')->onDelete('set null');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->enum('status',['pending','pinjam','kembali','terlambat','hilang']);
            $table->text('ket')->nullable();
            $table->text('nama_anggota')->nullable();
            $table->text('judul_buku')->nullable();
            // $table->string('kode_transaksi');
            //$table->foreignId('buku_id')->constrained('buku');
            //$table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}