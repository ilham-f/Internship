<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'seksi_id' => 1,
            'kebutuhan_magang_id' => 1,
            'email' => 1,
            'password' => 1,
            'role' => 'mahasiswa',
            'nama' => 'Ilham',
            'nim' => '152',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 1,
            'kebutuhan_magang_id' => 1,
            'email' => 2,
            'password' => 1,
            'role' => 'mahasiswa',
            'nama' => 'Ina',
            'nim' => '111',
            'jenis_kelamin' => 0,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 2,
            'kebutuhan_magang_id' => 2,
            'email' => 3,
            'password' => 2,
            'role' => 'mahasiswa',
            'nama' => 'Amel',
            'nim' => '222',
            'jenis_kelamin' => 0,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 3,
            'kebutuhan_magang_id' => 3,
            'email' => 4,
            'password' => 3,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 4,
            'kebutuhan_magang_id' => 4,
            'email' => 5,
            'password' => 4,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 5,
            'kebutuhan_magang_id' => 5,
            'email' => 6,
            'password' => 5,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 6,
            'kebutuhan_magang_id' => 6,
            'email' => 7,
            'password' => 6,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 7,
            'kebutuhan_magang_id' => 7,
            'email' => 8,
            'password' => 7,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 8,
            'kebutuhan_magang_id' => 8,
            'email' => 9,
            'password' => 8,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 9,
            'kebutuhan_magang_id' => 9,
            'email' => 10,
            'password' => 9,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 10,
            'kebutuhan_magang_id' => 10,
            'email' => 11,
            'password' => 10,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 11,
            'kebutuhan_magang_id' => 11,
            'email' => 12,
            'password' => 11,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 12,
            'kebutuhan_magang_id' => 12,
            'email' => 13,
            'password' => 12,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 13,
            'kebutuhan_magang_id' => 13,
            'email' => 14,
            'password' => 13,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 14,
            'kebutuhan_magang_id' => 14,
            'email' => 15,
            'password' => 14,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
        User::create([
            'seksi_id' => 15,
            'kebutuhan_magang_id' => 15,
            'email' => 16,
            'password' => 15,
            'role' => 'mahasiswa',
            'nama' => 'Reynaldi',
            'nim' => '333',
            'jenis_kelamin' => 1,
            'semester' => 6,
            'perguruan_tinggi' => 'Universitas Airlangga',
            'fakultas' => 'Vokasi',
            'jurusan' => 'Teknik Informatika',
            'pembimbing' => 'Ayu',
        ]);
    }
}
