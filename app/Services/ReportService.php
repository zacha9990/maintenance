<?php

namespace App\Services;

use App\Models\Factory;
use App\Models\Maintenance;
use App\Models\RepairRequest;
use App\Models\Tool;
use Carbon\Carbon;
use App\Models\ToolCategory;

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
            case 'laporan_realisasi_maintenance':
                $data = self::laporanRealisasiMaintenance($key);
                break;
            case 'laporan_riwayat_maintenance':
                $data = self::laporanRiwayatMaintenance($key);
                break;
            case 'daftar_pemeriksaan_mesin_alat_produksi':
                $data = self::daftarPemeriksaanMesinAlatProduksi($key);
                break;
            case 'daftar_pemeriksaan_generator_set':
                $data = self::daftarPemeriksaanGeneratorSet($key);
                break;
            case 'daftar_pemeriksaan_gedung_dan_sarana_lainnya':
                $data = self::daftarPemeriksaanGedungDanSaranaLainnya($key);
                break;
            case 'daftar_pemeriksaan_alat_pemadam_kebakaran':
                $data = self::daftarPemeriksaanAlatPemadamKebakaran($key);
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

    public static function daftarPemeriksaanAlatPemadamKebakaran($key)
    {
        $builder = config("reports.$key");
        $builder['factories'] = Factory::all();

        return $builder;
    }

    public static function daftarPemeriksaanGedungDanSaranaLainnya($key)
    {
        $builder = config("reports.$key");
        $builder['factories'] = Factory::all();

        return $builder;
    }

    public static function daftarPemeriksaanGeneratorSet($key)
    {
        $builder = config("reports.$key");
        $builder['factories'] = Factory::all();

        return $builder;
    }

    public static function daftarPemeriksaanMesinAlatProduksi($key)
    {
        $builder = config("reports.$key");
        $builder['factories'] = Factory::all();

        return $builder;
    }

    public static function laporanRiwayatMaintenance($key)
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

    public static function laporanRealisasiMaintenance($key)
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

    public static function getFactoryMaintenances($factoryId, $year)
    {
        return Maintenance::with('tool')
            ->whereHas('tool.factory', function ($query) use ($factoryId) {
                $query->where('id', $factoryId);
            })->where('status', 'completed')
            ->whereYear('created_at', $year)->get();
    }

    public static function getToolListsMonthly($factoryId, $month_year, $category)
    {
        $subCategories = ToolCategory::where('parent_id', $category)->pluck('id');

        $subCategories->push($category);

        return Tool::with(['maintenances' => function ($query) use ($month_year) {
            if (!empty($month_year)) {
                $query->whereYear('scheduled_date', date('Y', strtotime($month_year)))
                    ->whereMonth('scheduled_date', date('m', strtotime($month_year)));
            }
        }])
            ->with('category.maintenanceCriteria')
        ->whereIn('tool_type_id', $subCategories)
            ->where('factory_id', $factoryId)
            ->get();
    }

    public static function getToolListsYearly($factoryId, $year, $category)
    {
        $subCategories = ToolCategory::where('parent_id', $category)->pluck('id');

        $subCategories->push($category);

        return Tool::with(['maintenances' => function ($query) use ($year) {
            if (!empty($year)) {
                $query->whereYear('scheduled_date', $year);
            }
        }])
            ->with('category.maintenanceCriteria')
            ->with('inventory')
            ->whereIn('tool_type_id', $subCategories)
            ->where('factory_id', $factoryId)
            ->get();
    }
}
