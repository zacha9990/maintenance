<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            'Kepala PGT',
            'Supervisor Persediaan',
            'Supervisor Produksi & Mainteance',
            'Supervisor QC & HSE',
            'Supervisor Keu, SDM & Umum',
            'Maintenance',
            'Administrasi angkutan GT',
            'Kepala Shift II',
            'Kepala Shift III',
            'Kepala Shift I',
            'Operator Forklift III',
            'Quality Control Shift I',
            'Quality Control III',
            'Keamanan / Security Shift III',
            'Operator Settler & T Scrubing Shift III',
            'Penerima Getah',
            'Operator Settler & T Scrubing Shift II',
            'Operator Melter Shift II',
            'Operator Melter Shift I',
            'Operator Talang Getah & Blow Case Shift I',
            'Operator Forklift Shift II',
            'Operator Tengki Pemasak & Tengki Terpentin Shift III',
            'Operator Tengki Pemasak & Tengki Terpentin Shift I',
            'Operator Forklift Shift I',
            'Operator Tengki Pemasak & Tengki Terpentin Shift II',
            'Operator UPL - Penapis limbah Shift III',
            'Operator UPL - Penapis limbah Shift I',
            'Quality Control Shift II',
            'Operator Boliler Shift I',
            'Operator Boliler Shift II',
            'Operator Boliler Shift III',
            'Staf Keuangan & Data',
            'Keamanan/Security Shift I',
            'Cleaning Service (Tukang Kebun)',
            'Operator Settler & Tengki Scrubing Shift I',
            'Operator Talang Getah & Blow Case Shift III',
            'Operator Talang Getah & Blow Case Shift II',
            'Operator Melter Shift III',
            'Penerima Getah',
            'Operator Pengumpan bahan bakar Boiler Shift I',
            'Operator Pengumpan bahan bakar Boiler III',
            'Operator UPL - Netralisasi air limbah I',
            'Operator UPL - Netralisasi air limbah III',
            'Operator UPL - Netralisasi air limbah II',
            'Administrasi bahan baku & bahan penolong',
            'Operator Pengumpan bahan bakar Boiler II',
            'Keamanan / Security',
            'Operator UPL - Penapis limbah',
            'Staf SDM & Umum',
        ];

        foreach ($positions as $position) {
            Position::create(['name' => $position]);
        }
    }
}
