<?php

namespace App\Exports;

use App\Models\KebutuhanMagang;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class KebutuhanMagangExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KebutuhanMagang::select('kebutuhan','kualifikasi','output')->get();
    }

    public function headings(): array
    {
        return [
            'Kebutuhan',
            'Kualifikasi',
            'Output',
        ];
    }
}
