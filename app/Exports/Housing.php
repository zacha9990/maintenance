<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class Housing implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStrictNullComparison
{
    protected $data;

    use Exportable;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'Nama Perumahan',
            'Alamat',
            'Kecamatan',
            'Desa',
            'Status',
            'Tipe',
            'Longitude',
            'Latitude',
        ];
    }

    public function map($data): array
    {
        return  [
            $data['house_name'],
            $data['address'],
            $data['district_name'],
            $data['village_name'],
            $data['status'],
            $data['type'],
            $data['longitude'],
            $data['latitude'],
        ];
    }
}
