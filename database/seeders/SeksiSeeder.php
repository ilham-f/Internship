<?php

namespace Database\Seeders;

use App\Models\Seksi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SEKRETARIAT
        Seksi::create([
            'nama_seksi' => 'Sub Bagian Umum dan Kepegawaian',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Sub Substansi Perencanaan Program dan Anggaran',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Sub Substansi Keuangan',
            'deskripsi' => 'ini deskripsi seksi'
        ]);

        // KESMAS
        Seksi::create([
            'nama_seksi' => 'Seksi Kesehatan Keluarga dan Gizi Masyarakat',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Seksi Tata Kelola Kesehatan Masyarakat',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Sub Substansi Promosi Kesehatan dan Pemberdayaan Masyarakat',
            'deskripsi' => 'ini deskripsi seksi'
        ]);

        // P2P
        Seksi::create([
            'nama_seksi' => 'Seksi Pencegahan dan Pengendalian Penyakit Menular dan Tidak Menular',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Seksi Penyehatan Lingkungan',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Sub Substansi Surveilans dan Imunisasi',
            'deskripsi' => 'ini deskripsi seksi'
        ]);

        // PELAYANAN KESEHATAN
        Seksi::create([
            'nama_seksi' => 'Seksi Pelayanan Kesehatan Rujukan',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Seksi Pelayanan Kesehatan Primer',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Sub Substansi Tata Kelola Pelayanan Kesehatan',
            'deskripsi' => 'ini deskripsi seksi'
        ]);

        // SDK
        Seksi::create([
            'nama_seksi' => 'Seksi Kefarmasian dan Alat Kesehatan',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Seksi Sumber Daya Manusia Kesehatan',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
        Seksi::create([
            'nama_seksi' => 'Sub Substansi Pembiayaan Kesehatan',
            'deskripsi' => 'ini deskripsi seksi'
        ]);
    }
}
