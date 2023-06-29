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
        <h3>DAFTAR PERMINTAAN PERBAIKAN MESIN ALAT PRODUKSI EXTERNAL</h3>
    </div>

    <hr>

    <table class="table table-borderless">
        <tr>
            <td>
                Pada hari ini: {{ $letter_day }}, {{ $letter_date }}
            </td>
        </tr>
        <tr>
            <td>Kami yang bertanda tangan dibawah ini :</td>
        </tr>
        <tr class="my-2">
            <td>
                <li>
                    <ol>
                        Maintenance: {{ $maintenanceName }}
                    </ol>
                    <ol>
                        Kepala Shift: {{ $kepalaShiftName }}
                    </ol>
                </li>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Atas dasar permintaan perbaikan mesin/alat produksi (External) tanggal
                    {{ Carbon::parse($maintenance->completed_date)->translatedFormat('j Y H') }}
                </p>
                <p>kami telah mengadakan pemeriksaan terhadap mesin/alat produksi yang dilaporkan rusak, dengan hasil
                    sebagai berikut:</p>
            </td>
        </tr>
    </table>

    <table class="table table-borderless">
        <tr>
            <td>Nama Mesin/Alat Produksi</td>
            <td>{{ $maintenance->tool->name }}</td>
        </tr>
        <tr>
            <td>Kondisi</td>
            <td>{{ $maintenance->repairRequest->description }}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>{{ $maintenance->description }}</td>
        </tr>
    </table>

    <table class="table table-borderless">
        <tr>
            <td>
                <p>Demikian berita acara ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
            </td>
        </tr>
    </table>

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
                <p class="text-center">Mengetahui<br>Supervisor Produksi & <br> Maintenance</p>
            </td>
            <td>
                <p class="text-center">Yang Memeriksa</p>
            </td>

        </tr>
        <tr style="margin:20px 0 20px 0">
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>
                <p class="text-center">---</p>
            </td>

            <td>
                <p class="text-center">---</p>
            </td>
        </tr>
    </table>



</body>

</html>
