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
        ],
        "description" => "Daftar Mesin dan Alat Produksi Pabrik"
    ],
    "daftar_permintaan_perbaikan_mesin_alat_produksi_external" => [
        "slug" => "daftar_permintaan_perbaikan_mesin_alat_produksi_external",
        "name" => "Daftar permintaan perbaikan mesin alat produksi external",
        "input" => [
            [
                "id" => "no_laporan",
                "text" => "Nomor Laporan"
            ]
        ],
        "description" => ""
    ],
    "daftar_permintaan_perbaikan_mesin_alat_produksi_internal" => [
        "slug" => "daftar_permintaan_perbaikan_mesin_alat_produksi_internal",
        "name" => "Daftar permintaan perbaikan mesin alat produksi internal",
        "input" => [
            [
                "id" => "no_laporan",
                "text" => "Nomor Laporan"
            ]
        ],
        "description" => ""
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
        ],
        "description" => "Daftar Maintenance diambil dari proses maintenance yang sudah selesai, yang tipenya adalah laporan kerusakan"
    ],
    "daftar_rekap_pelaksanaan_pekerjaan_perawatan_dan_perbaikan_mesin_alat_produksi" => [
        "slug" => "daftar_rekap_pelaksanaan_pekerjaan_perawatan_dan_perbaikan_mesin_alat_produksi",
        "name" => "Daftar rekap pelaksanaan pekerjaan perawatan dan perbaikan mesin alat produksi",
        "input" => [
            [
                "id" => "no_laporan",
                "text" => "Nomor Laporan"
            ]
        ],
        "description" => ""

    ],
    "laporan_realisasi_maintenance" => [
        "slug" => "laporan_realisasi_maintenance",
        "name" => "Laporan realisasi maintenance",
        "input" => [
            [
                "id" => "no_laporan",
                "text" => "Nomor Laporan"
            ],
            [
                "id" => "nama_maintenance",
                "text" => "Nama maintenance"
            ],
            [
                "id" => "nama_spv",
                "text" => "Nama SPV"
            ],
            [
                "id" => "kepala_pabrik",
                "text" => "Kepala pabrik"
            ],
            [
                "id" => "realisasi_dari_formulir",
                "text" => "Realisasi dari Formulir"
            ]
        ],
        "description" => "Daftar Maintenance diambil dari proses maintenance yang sudah selesai. Bisa juga mencetaknya dari menu daftar maintenance."
    ],





];

return $reports;
