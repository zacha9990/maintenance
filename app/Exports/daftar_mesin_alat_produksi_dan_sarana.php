<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class daftar_mesin_alat_produksi_dan_sarana implements FromView
{
    protected $factory;
    protected $no_laporan;
    protected $tools;

    function __construct($factory, $no_laporan, $tools)
    {
        $this->factory = $factory;
        $this->tools = $tools;
        $this->no_laporan = $no_laporan;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view(
            'exports.daftar_mesin_alat_produksi_dan_sarana',
            [
                "factory" => $this->factory,
                "tools" => $this->tools,
                "no_laporan" => $this->no_laporan
            ]
        );
    }
}
