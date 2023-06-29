<?php
$reports = [
    "daftar_mesin_alat_produksi_dan_sarana" =>
    [
        "slug" => "daftar_mesin_alat_produksi_dan_sarana",
        "name" => "Daftar mesin alat produksi dan sarana",
        "input" => [
            [
                "id" => "no_laporan",
                "text" => "Nomor Laporan"
            ]
        ]
    ],
    "daftar_permintaan_perbaikan_mesin_alat_produksi_external" => [
        "slug" => "daftar_permintaan_perbaikan_mesin_alat_produksi_external",
        "name" => "Daftar permintaan perbaikan mesin alat produksi external",
        "input" => [
            [
                "id" => "no_laporan",
                "text" => "Nomor Laporan"
            ]
        ]
    ],
    "daftar_permintaan_perbaikan_mesin_alat_produksi_internal" => [
        "slug" => "daftar_permintaan_perbaikan_mesin_alat_produksi_internal",
        "name" => "Daftar permintaan perbaikan mesin alat produksi internal",
        "input" => [
            [
                "id" => "no_laporan",
                "text" => "Nomor Laporan"
            ]
        ]
    ],
    "berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi" => [
        "slug" => "berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi",
        "name" => "Berita acara pemeriksaan kerusakan mesin alat produksi",
        "input" => [
            [
                "id" => "no_laporan",
                "text" => "Nomor Laporan"
            ],
            [
                "id" => "maintenance",
                "text" => "Maintenance"
            ],
            [
                "id" => "kepala_shift",
                "text" => "Nama Kepala Shift"
            ]
        ]
    ]


];

return $reports;
