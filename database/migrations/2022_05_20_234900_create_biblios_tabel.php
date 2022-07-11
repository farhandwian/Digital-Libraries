<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBibliosTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biblio', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('isbn');
            $table->string('penulis');
            $table->string('penerbit');
            $table->integer('tahun_terbit');
            $table->enum('tipe_koleksi',['reference','text-book','fiction','non-fiction'])->nullable();
            $table->integer('jumlah_buku')->default(0);
            $table->integer('stok')->default(0);
            $table->integer('total_dipinjam')->default(0);       
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->float('rating');
            $table->integer('total_reviewer');
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
        Schema::dropIfExists('biblio');
    }
}