<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

echo "Creating peminjaman table...\n";

Schema::create('peminjaman', function (Blueprint $table) {
    $table->id();
    $table->string('kode_peminjaman')->unique();
    $table->foreignId('siswa_id')->constrained('students')->onDelete('cascade');
    $table->date('tanggal_pinjam');
    $table->date('tanggal_batas_kembali');
    $table->date('tanggal_kembali')->nullable();
    $table->enum('status', ['Dipinjam', 'Dikembalikan', 'Terlambat'])->default('Dipinjam');
    $table->text('keterangan')->nullable();
    $table->timestamps();
});

echo "Creating peminjaman_items table...\n";

Schema::create('peminjaman_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('peminjaman_id')->constrained('peminjaman')->onDelete('cascade');
    $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
    $table->integer('jumlah');
    $table->string('kondisi_saat_dipinjam')->nullable();
    $table->string('kondisi_saat_dikembalikan')->nullable();
    $table->timestamps();
});

echo "Done! Tables created successfully.\n";
