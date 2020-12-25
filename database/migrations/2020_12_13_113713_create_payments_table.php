<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_payment');
            $table->string('kode_kartu');
            $table->timestamp('waktu_bayar');
            $table->string('pelanggan');
            $table->integer('total_cuci');
            $table->string('kode_promo')->nullable();
            $table->integer('diskon')->nullable();
            $table->integer('total_bayar');
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
        Schema::dropIfExists('payments');
    }
}
