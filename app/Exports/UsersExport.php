<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::join('seksis', 'users.seksi_id', '=', 'seksis.id')
                    ->select('nama','email','nim','perguruan_tinggi',
                            'fakultas','jurusan','nama_seksi','tgl_mulai','tgl_selesai')
                    ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'NIM',
            'Perguruan Tinggi',
            'Fakultas',
            'Program Studi',
            'Penempatan',
            'Tanggal Mulai',
            'Tanggal Selesai',
        ];
    }
}
