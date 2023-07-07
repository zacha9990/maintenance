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
    @if($preview)
        <a href="{{ route('reports.reportForm', $param) }}" class="btn btn-danger">Kembali</a>

    @endif

    <div class="document-number">
        <p>No Dokumen: {{ $no_laporan }}</p>
    </div>
    <div class="table-title text-center">
        <h3>PENGGUNAAN SPAREPART</h3>
        <h3>{{ $factory->name }}</h3>
    </div>

    <hr>

    <table class="table table-borderless table-sm">
        <tr>
            <td>{{ $tanggal }}</td>
        </tr>
    </table>

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
            <th>No</th>
            <th>Jenis</th>
            <th>Volume</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach ($spareparts as $sparepart)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $sparepart->sparepart_name }}</td>
                    <td>1</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <table class="table table-borderless">

        <tr>
            <td>
                <p class="text-center">Yang Menyerahkan</p>
            </td>
            <td>
                <p class="text-center">Mengetahui</p>
            </td>
            <td>
                <p class="text-center">Yang Menerima</p>
            </td>
        </tr>
        <tr style="margin:20px 0 20px 0">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td>
                <p class="text-center">{{ $yang_menyerahkan}}</p>
            </td>
            <td>
                <p class="text-center">{{ $mengetahui }}</p>
            </td>
            <td>
                <p class="text-center">{{ $yang_menerima }}</p>
            </td>
        </tr>
    </table>





</body>

</html>
