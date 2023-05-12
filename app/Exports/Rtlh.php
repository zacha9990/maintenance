<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;


class Rtlh extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStrictNullComparison, WithCustomValueBinder
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
            'Name',
            'No Ktp',
            'No Kk',
            'Jumlah Kk dalam satu rumah',
            'No Telepon',
            'Umur',
            'Jenis Kelamin',
            'Alamat',
            'Kecamtan',
            'Desa',
            'Pendidikan',
            'Pekerjaan',
            'Penghasilan',
            'Kepemilikan Rumah',
            'Aset Rumah di Tempat Lain',
            'Status Kepemilikan Tanah',
            'Aset Tanah di Tempat Lain',
            'Sumber Penerangan',
            'Bantuan Perumahan',
            'Jenis Kawasan',
            'Fungsi (RTRW Kab/Kota)',
            'Fondasi',
            'Sloof',
            'Kolom',
            'Ring Balok',
            'Rangka Atap',
            'Lantai',
            'Dinding',
            'Jendela',
            'Ventilasi',
            'Plafon',
            'Penutup Atap',
            'Sumber Air Minum',
            'Jarak ke Pembuangan Tinja',
            'Fasilitas Bab',
            'Jenis Jamban',
            'Tpa Tinja',
            'Luas Rumah',
            'Luas Tanah',
            'Jumlah Penghuni',
            'Rasio Luas Bangunan Rumah (M2) Terhadap Jumlah Penghuni Rumah',
            'Longitude',
            'Latitude',
            'Proposal',
        ];
    }

    public function map($data): array
    {
        return  [
            $data['name'],
            $data['no_ktp'],
            $data['no_kk'],
            $data['jml_kk'],
            $data['phone'],
            $data['umur'],
            $data['jk'],
            $data['address'],
            $data['district_name'],
            $data['village_name'],
            $data['pendidikan'],
            $data['pekerjaan'],
            $data['penghasilan'],
            $data['kep_rumah'],
            $data['asset_rumah'],
            $data['status_tanah'],
            $data['asset_tanah'],
            $data['sumber_penerangan'],
            $data['bantuan_perumahan'],
            $data['kawasan'],
            $data['fungsi'],
            $data['fondasi'],
            $data['sloof'],
            $data['kolom'],
            $data['ring_balok'],
            $data['rangka_atap'],
            $data['lantai'],
            $data['dinding'],
            $data['jendela'],
            $data['ventilasi'],
            $data['plafon'],
            $data['penutup_atap'],
            $data['sumber_air'],
            $data['jarak_tinja'],
            $data['fasilitas_bab'],
            $data['jenis_jamban'],
            $data['tpa_tinja'],
            $data['luas_rumah'],
            $data['luas_tanah'],
            $data['jumlah_penghuni'],
            $data['rasio_luas'],
            $data['longitude'],
            $data['latitude'],
        ];
    }
}
