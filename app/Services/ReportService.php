<?php

namespace App\Services;

use App\Models\Factory;


class ReportService
{
    public static function getData($key)
    {
        if ($key == 'daftar_mesin_alat_produksi_dan_sarana') {
            $data = self::daftarMesinAlatProduksiDanSarana($key);
        }

        return $data;
    }

    public static function daftarMesinAlatProduksiDanSarana($key)
    {
        $builder = config("reports.$key");
        $builder['factories'] = Factory::all();

        return $builder;
    }
}
