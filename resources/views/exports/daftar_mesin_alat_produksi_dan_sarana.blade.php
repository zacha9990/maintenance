<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
        <style type="text/css">
            table tr td,
            table tr th{
                font-size: 9pt;
            }
        </style>


            <div class="document-number">
                <p>No Dokumen: {{ $no_laporan }}</p>
            </div>
            @if($preview)
                <a href="{{ route('reports.reportForm', $param) }}" class="btn btn-danger">Kembali</a>
            @endif
            <div class="table-title text-center">
                <h3>DAFTAR MESIN/ALAT PRODUKSI DAN SARANA LAINNYA {{ $factory->name }} KBM IHHBK JATENG</h3>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Alat</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Spesifikasi</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                    <tr class="text-center">
                        <th scope="col">1</th>
                        <th scope="col">2</th>
                        <th scope="col">3</th>
                        <th scope="col">4</th>
                        <th scope="col">5</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach ($tools as $tool)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $tool->name }}</td>
                            <td>1</td>
                            <td>{{ $tool->technical_specification }}</td>
                            <td></td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                </tbody>
            </table>

            <table class="table table-borderless">
                <tr>
                    <td> <p class="text-center">Disetujui<br>Kepala {{ $factory->name }}</p></td>
                    <td> <p class="text-center">Diperiksa<br>Supervisor Produksi & Maintenance</p></td>
                    <td><p class="text-center">Dibuat Oleh:<br>Maintenance</p></td>
                </tr>
                <tr style="margin:20px 0 20px 0">
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td> <p class="text-center">{{ $kepala_pabrik }}</p></td>
                    <td> <p class="text-center">{{ $nama_spv_prod_maint }}</p></td>
                    <td><p class="text-center">{{ $nama_maintenance }}</p></td>
                </tr>
            </table>



    </body>
</html>
