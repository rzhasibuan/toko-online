<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categories_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnails');
            $table->string('jenis_bahan');
            $table->string('detail_bahan');
            $table->string('spesifikasi_bahan');
            $table->string('bonus');
            $table->integer('stok');
            $table->string('price');
            $table->string('weight');
            $table->text('description');
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
        Schema::dropIfExists('products');
    }
}
