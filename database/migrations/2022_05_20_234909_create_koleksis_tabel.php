<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoleksisTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koleksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biblio_id')->constrained('biblio')->onUpdate('cascade')->onDelete('restrict');
            $table->string('kode_eksemplar')->unique();
            $table->string('no_reg');
            $table->string('lokasi');
            $table->enum('status',['tersedia','dipesan','dipinjam','hilang']);
            $table->nullable()->enum('kondisi',['cukup bagus','bagus','sangat bagus']);
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
        Schema::dropIfExists('koleksi');
    }
}