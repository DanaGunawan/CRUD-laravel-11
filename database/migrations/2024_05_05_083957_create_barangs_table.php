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
        Schema::create('barangs', function (Blueprint $table) {
            $table->integer('id_produk')->unique()->notNullable();
            $table->string('nama_produk', 100)->notNullable();
            $table->string('foto_produk', 200)->nullable();
            $table->string('kategori', 25)->notNullable();
            $table->integer('harga')->notNullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
