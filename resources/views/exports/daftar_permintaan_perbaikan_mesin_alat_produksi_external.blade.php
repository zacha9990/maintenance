<!DOCTYPE html>
<html>

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

    <table class="table table-borderless">
        <tr>
            <td>
                Kepada Yth: <br/>
                Kepala Pabrik {{ $factory->name }}
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>Terlampir adalah mesin/alat produksi yang perlu perbaikan External</td>
        </tr>
    </table>

    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Nama Alat</th>
                <th scope="col">Jenis Kerusakan</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach ($maintenances as $maintenance)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $maintenance['tool_name'] }}</td>
                    <td>{{ $maintenance['repair_request_description'] }}</td>
                    <td></td>
                </tr>
                @php $i++ @endphp
            @endforeach
        </tbody>
    </table>

    <table class="table table-borderless mb-3">
        <tr>
            <td>Demikian untuk menjadi periksa dan mohon persetujuannya.</td>
        </tr>
    </table>

    <table class="table table-borderless">
        <tr>
            <td></td>
            <td></td>
            <td class="text-right">
                <p>............, tgl.........................</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="text-center">Menyetujui<br>Supervisor Produksi & <br> Maintenance</p>
            </td>
            <td>
                <p class="text-center">Menyetujui<br>Kepala {{ $factory->name }}</p>
            </td>
            <td>
                <p class="text-center">Yang Mengajukan</p>
            </td>
        </tr>
        <tr style="margin:20px 0 20px 0">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td>
                <p class="text-center">---</p>
            </td>
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
