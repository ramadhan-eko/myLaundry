<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCucianItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cucian_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_kartu');
            $table->string('id_service');
            $table->string('produk');
            $table->integer('harga_satuan');
            $table->integer('quantity');
            $table->integer('total');
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
        Schema::dropIfExists('cucian_items');
    }
}
