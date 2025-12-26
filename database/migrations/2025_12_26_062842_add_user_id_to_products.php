<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // tambah kolom user_id (nullable dulu supaya aman kalau tabel berisi data)
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // isi user_id sementara untuk data yang sudah ada
        // ubah angka 1 sesuai id user yang kamu miliki
        DB::table('products')->whereNull('user_id')->update(['user_id' => 1]);

        // setelah semua baris punya user_id, baru pasang foreign key
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // hapus foreign key dulu, baru kolomnya
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
