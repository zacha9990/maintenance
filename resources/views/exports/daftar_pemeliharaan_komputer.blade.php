<!DOCTYPE html>
<html>
@php use Carbon\Carbon; @endphp

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>


    <div class="document-number">
        <p>No Dokumen: {{ $no_laporan }}</p>
    </div>
    <div class="table-title text-center">
        <h3> DAFTAR PEMELIHARAAN KOMPUTER</h3>
        <h6>Tahun: {{ $year }}</h6>
        <h6>{{ $factory->name }}</h3>
    </div>

    <hr>

    <table class="table table-bordered table-sm table-condensed">
        <thead class="text-center">
            <tr>
                <th class="narrow" rowspan="2">No</th>
                <th rowspan="2">Kegiatan</th>
                <th rowspan="2">Rincian Kegiatan</th>
                @php
                    $totalDays = 12;
                @endphp
                <th colspan="{{ $totalDays }}">Rencana (Bulan)</th>
                <th colspan="{{ $totalDays }}">Realisasi (Bulan)</th>
            </tr>
            <tr>
                @php
                    for ($day = 1; $day <= $totalDays; $day++) {
                        echo '<th class="narrow">' . $day . '</th>';
                    }
                @endphp
                @php
                    for ($day = 1; $day <= $totalDays; $day++) {
                        echo '<th class="narrow">' . $day . '</th>';
                    }
                @endphp
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach ($tools as $tool)
                @php
                    $rowspan = $tools->first()->category->maintenanceCriteria->count() > 1 ? $tools->first()->category->maintenanceCriteria->count() : 1;
                    $maintenances = $tool->maintenances;
                @endphp

                <tr>
                    <td class="narrow" rowspan="{{ $rowspan }}">{{ $i }}</td>
                    <td rowspan="{{ $rowspan }}">{{ $tool->name }}</td>

                    <td>{{ $tool->category->maintenanceCriteria ? $tool->category->maintenanceCriteria[0]->name : '' }}
                    </td>

                    {{-- Untuk Rencana --}}
                    @php
                        for ($day = 1; $day <= $totalDays; $day++) {
                            if (count($maintenances) > 0) {
                                foreach ($maintenances as $maintenance) {
                                    if(is_array($maintenance->details))
                                    {
                                        $criterias = $maintenance->details['criterias'];
                                        $carbonDate = Carbon::parse($maintenance->scheduled_date);
                                        if ($carbonDate->month == $day) {
                                            // foreach ($criterias as $criteria) {
                                            //     if ($criteria['id'] == $tool->category->maintenanceCriteria[0]->id) {
                                            //         $result = $criteria['result'] == 'good' ? 'V' : 'X';
                                            //     }
                                            // }
                                            echo '<td class="narrow text-center">' . "R" . '</td>';
                                            continue;
                                        } else {
                                            echo '<td class="narrow text-center"></td>';
                                        }
                                    }
                                }
                            } else {
                                echo '<td class="narrow text-center"></td>';
                            }
                        }
                    @endphp

                    {{-- Untuk Realisasi --}}
                    @php
                        for ($day = 1; $day <= $totalDays; $day++) {
                            if (count($maintenances) > 0) {
                                foreach ($maintenances as $maintenance) {
                                    if(is_array($maintenance->details))
                                    {
                                        $criterias = $maintenance->details['criterias'];
                                        $carbonDate = Carbon::parse($maintenance->scheduled_date);
                                        if ($carbonDate->month == $day) {
                                            foreach ($criterias as $criteria) {
                                                if ($criteria['id'] == $tool->category->maintenanceCriteria[0]->id) {
                                                    $result = $criteria['result'] == 'good' ? 'V' : 'X';
                                                }
                                            }
                                            echo '<td class="narrow text-center">' . $result . '</td>';
                                            continue;
                                        } else {
                                            echo '<td class="narrow text-center"></td>';
                                            continue;
                                        }
                                    }
                                }
                            } else {
                                echo '<td class="narrow text-center"></td>';
                            }
                        }
                    @endphp
                </tr>
                @for ($j = 1; $j < $rowspan; $j++)
                    <tr>
                        <td>{{ $tool->category->maintenanceCriteria ? $tool->category->maintenanceCriteria[$j]->name : '' }}
                        </td>
                        @php
                            for ($day = 1; $day <= $totalDays; $day++) {
                                if (count($maintenances) > 0) {
                                    foreach ($maintenances as $maintenance) {
                                        if(is_array($maintenance->details))
                                        {
                                            $criterias = $maintenance->details['criterias'];
                                            $carbonDate = Carbon::parse($maintenance->scheduled_date);
                                            if ($carbonDate->month == $day) {
                                                echo '<td class="narrow text-center">' . "R" . '</td>';
                                                continue;
                                            } else {
                                                echo '<td class="narrow text-center"></td>';
                                                continue;
                                            }
                                        }
                                    }
                                } else {
                                    echo '<td class="narrow text-center"></td>';
                                }
                            }
                        @endphp
                        @php
                        for ($day = 1; $day <= $totalDays; $day++) {
                            if (count($maintenances) > 0) {
                                foreach ($maintenances as $maintenance) {
                                    if(is_array($maintenance->details))
                                    {
                                        $criterias = $maintenance->details['criterias'];
                                        $carbonDate = Carbon::parse($maintenance->scheduled_date);
                                        if ($carbonDate->month == $day) {
                                            foreach ($criterias as $criteria) {
                                                if ($criteria['id'] == $tool->category->maintenanceCriteria[0]->id) {
                                                    $result = $criteria['result'] == 'good' ? 'V' : 'X';
                                                }
                                            }
                                            echo '<td class="narrow text-center">' . $result . '</td>';
                                            continue;
                                        } else {
                                            echo '<td class="narrow text-center"></td>';
                                            continue;
                                        }
                                    }
                                }
                            } else {
                                echo '<td class="narrow text-center"></td>';
                            }
                        }
                    @endphp
                    </tr>
                @endfor
                @php $i++; @endphp
            @endforeach
        </tbody>
    </table>

    <table class="table table-borderless">
        <tr>

            <td></td>
            <td class="text-right">
                <p>............, tgl.........................</p>
            </td>
        </tr>
        <tr>

            <td>
                <p class="text-center">Mengetahui Kepala Pabrik</p>
            </td>
            <td>
                <p class="text-center">Maintenance</p>
            </td>
        </tr>
        <tr style="margin:20px 0 20px 0">
            <td colspan="3"></td>
        </tr>
        <tr>

            <td>
                <p class="text-center">{{ $kepala_pabrik }}</p>
            </td>
            <td>
                <p class="text-center">{{ $nama_maintenance }}</p>
            </td>
        </tr>
    </table>





</body>

</html>
