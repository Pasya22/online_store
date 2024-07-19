<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create roles table
        Schema::create('role', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('role', 255);
            $table->timestamps();
        });

        // Create users table
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->unsignedBigInteger('id_role');
            $table->string('foto', 255);
            $table->string('nama_lengkap', 255);
            $table->string('email', 255);
            $table->string('username', 255);
            $table->string('password', 255);
            $table->string('telephone', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_role')->references('id_role')->on('role');
        });

        // Create data_kategori table
        Schema::create('data_kategori', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori', 255);
            $table->timestamps();
        });

        // Create data_barangs table
        Schema::create('data_barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_barang', 255);
            $table->string('harga', 255);
            $table->string('stok', 255);
            $table->string('gambar', 255);
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('data_kategori');
        });

        // Create data_pembayarans table
        Schema::create('data_pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_user');
            $table->integer('jumlah_barang');
            $table->integer('total_harga');
            $table->integer('id_diskon')->nullable();
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('data_barang');
            $table->foreign('id_user')->references('id_user')->on('user');
        });

        // Create diskons table
        Schema::create('diskon', function (Blueprint $table) {
            $table->id('id_diskon');
            $table->unsignedBigInteger('id_barang')->nullable();
            $table->integer('diskon')->nullable();
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('data_barang');
        });
    }

    public function down()
    {
        Schema::dropIfExists('diskon');
        Schema::dropIfExists('data_pembayaran');
        Schema::dropIfExists('data_barang');
        Schema::dropIfExists('data_kategori');
        Schema::dropIfExists('user');
        Schema::dropIfExists('role');
    }
};
