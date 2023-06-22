<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Models\Factory;
use App\Models\Tool;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\daftar_mesin_alat_produksi_dan_sarana;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $reports = config('reports');

        return view('reports.index', compact('reports'));
    }

    public function reportForm($param)
    {
        $builder = ReportService::getData($param);
        return view("reports.$param", compact('builder'));
    }

    public function generateForm(Request $request, $param)
    {

        $factory = Factory::findOrFail($request->input('factory_id'));
        $no_laporan = $request->input('no_laporan');
        $tools = Tool::where('factory_id', $request->input('factory_id'))->get();

        $data = [
            'no_laporan' => $no_laporan, // Replace with your variable values
            'factory' => $factory,
            'tools' => $tools,
        ];


        $pdf = PDF::loadView("exports.$param", $data);

        return $pdf->stream("$param.$factory->name.pdf");

        // return Excel::download(new daftar_mesin_alat_produksi_dan_sarana($factory, $no_laporan, $tools), 'daftar_mesin_alat_produksi_dan_sarana', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
