<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundryCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_kartu');
            $table->integer('id_pelanggan');
            $table->timestamp('waktu_masuk');
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamp('waktu_diambil')->nullable();
            $table->string('pembayaran');
            // pembayaran = pending, selesai
            $table->string('status');
            // status = hold, cuci, finish
            $table->integer('total_harga');
            $table->softDeletes();
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
        Schema::dropIfExists('laundry_cards');
    }
}
