@extends('layouts.admin')

@section('css-after-bootstrap')

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="mt-4">Daftar Peralatan</h1>

            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Nomor Seri</th>
                <th>Fungsi</th>
                <th>Merek</th>
                <th>Tipe Seri</th>
                <th>Tanggal Pembelian</th>
                <th>Spesifikasi Teknis</th>
                <th>Pabrik</th>
                <th>Tanggal Dibuat</th>
                <th>Tanggal Diperbarui</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Dummy Data -->
              <tr>
                <td>1</td>
                <td>Palu</td>
                <td>PL-001</td>
                <td>Memukul</td>
                <td>ABC</td>
                <td>Standar</td>
                <td>2022-01-01</td>
                <td>Palu dengan pegangan kayu</td>
                <td>1</td>
                <td>2022-01-01 10:00:00</td>
                <td>2022-01-01 10:00:00</td>
                <td>
                  <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                  <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Gergaji</td>
                <td>GRG-002</td>
                <td>Memotong</td>
                <td>XYZ</td>
                <td>Elektrik</td>
                <td>2022-02-01</td>
                <td>Gergaji listrik dengan pisau tajam</td>
                <td>2</td>
                <td>2022-02-01 09:30:00</td>
                <td>2022-02-01 09:30:00</td>
                <td>
                  <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                  <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Pisau</td>
                <td>PS-003</td>
                <td>Melukis</td>
                <td>DEF</td>
                <td>Standar</td>
                <td>2022-03-01</td>
                <td>Pisau dengan mata tajam untuk melukis</td>
                <td>1</td>
                <td>2022-03-01 11:00:00</td>
                <td>2022-03-01 11:00:00</td>
                <td>
                  <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                  <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td>Bor</td>
                <td>BR-004</td>
                <td>Membor</td>
                <td>GHI</td>
                <td>Elektrik</td>
                <td>2022-04-01</td>
                <td>Bor listrik dengan berbagai kecepatan</td>
                <td>2</td>
                <td>2022-04-01 10:30:00</td>
                <td>2022-04-01 10:30:00</td>
                <td>
                  <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                  <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                </td>
              </tr>
              <tr>
                <td>5</td>
                <td>Sekop</td>
                <td>SKP-005</td>
                <td>Menggali</td>
                <td>JKL</td>
                <td>Standar</td>
                <td>2022-05-01</td>
                <td>Sekop dengan pegangan kayu</td>
                <td>1</td>
                <td>2022-05-01 09:00:00</td>
                <td>2022-05-01 09:00:00</td>
                <td>
                  <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                  <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                </td>
              </tr>
              <!-- End of Dummy Data -->
            </tbody>
          </table>
    </div>
</div>
@endsection

@section('scripts')

</script>
@endsection
