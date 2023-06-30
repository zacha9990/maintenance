<?php

namespace App\Services;

use App\Models\Factory;
use App\Models\Maintenance;
use App\Models\RepairRequest;
use Carbon\Carbon;

class ReportService
{
    public static function getData($key)
    {
        $data = null;

        switch ($key) {
            case 'daftar_mesin_alat_produksi_dan_sarana':
                $data = self::daftarMesinAlatProduksiDanSarana($key);
                break;
            case 'daftar_permintaan_perbaikan_mesin_alat_produksi_external':
                $data = self::daftarPermintaanPerbaikanMesinAlatProduksiExternal($key);
                break;
            case 'daftar_permintaan_perbaikan_mesin_alat_produksi_internal':
                $data = self::daftarPermintaanPerbaikanMesinAlatProduksiInternal($key);
                break;
            case 'berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi':
                $data = self::beritaAcaraPemeriksaanKerusakanMesinAlatProduksi($key);
                break;
            case 'daftar_rekap_pelaksanaan_pekerjaan_perawatan_dan_perbaikan_mesin_alat_produksi':
                $data = self::daftarRekapPelaksanaanPekerjaanPerawatanDanPerbaikanMesinAlatProduksi($key);
                break;
        }

        return $data;
    }

    public static function daftarMesinAlatProduksiDanSarana($key)
    {
        $builder = config("reports.$key");
        $builder['factories'] = Factory::all();

        return $builder;
    }

    public static function beritaAcaraPemeriksaanKerusakanMesinAlatProduksi($key)
    {
        $builder = config("reports.$key");

        return $builder;
    }

    public static function daftarPermintaanPerbaikanMesinAlatProduksiExternal($key)
    {
        $builder = config("reports.$key");
        $builder['factories'] = Factory::all();

        return $builder;
    }

    public static function daftarRekapPelaksanaanPekerjaanPerawatanDanPerbaikanMesinAlatProduksi($key)
    {
        $builder = config("reports.$key");
        $builder['factories'] = Factory::all();

        return $builder;
    }

    public static function daftarPermintaanPerbaikanMesinAlatProduksiInternal($key)
    {
        $builder = config("reports.$key");
        $builder['factories'] = Factory::all();

        return $builder;
    }

    public static function getRepairRequest($factoryId, $startDate, $endDate, $external = true)
    {
        $maintenances = RepairRequest::with('tool')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereHas('tool.factory', function ($query) use ($factoryId) {
                $query->where('id', $factoryId);
            })
            ->when($external, function ($query) {
                $query->where('maintenance_type', 'External');
            })
            ->when(!$external, function ($query) {
                $query->where('maintenance_type', 'Internal');
            })
            ->get();

        // Mengambil data yang dibutuhkan
        $data = $maintenances->map(function ($maintenance) {
            return [
                'maintenance_id' => $maintenance->id,
                'tool_id' => $maintenance->tool->id,
                'tool_name' => $maintenance->tool->name,
                'repair_request_description' => $maintenance->description,
            ];
        });

        return $data;
    }

    public static function getListBeritaAcaraPemeriksaanKerusakanMesinAlatProduksi()
    {
        // Add your implementation here
    }

    public static function getFinishedMaintenance($factoryId, $startDate, $endDate)
    {
        return Maintenance::with('repairRequest')->with('tool')
        ->where('status', 'completed')
        ->whereBetween('completed_date', [$startDate, $endDate])
            ->whereHas('tool.factory', function ($query) use ($factoryId) {
                $query->where('id', $factoryId);
            })
            ->orderBy('id')
            ->get();
    }
}
