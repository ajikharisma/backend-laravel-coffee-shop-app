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
        Schema::table('products', function (Blueprint $table) {
            // Tambahkan kolom user_id dan buat relasi ke tabel users
            $table->unsignedBigInteger('user_id')->after('id');

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); // jika user dihapus, produk ikut terhapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus relasi & kolom jika rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
