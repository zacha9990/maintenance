@extends('layouts.admin')

@section('css-after-bootstrap')

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="mt-4">Daftar Peralatan</h1>
        <div class="mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addToolModal"><i class="fas fa-plus"></i> Tambah Peralatan</button>
          </div>
        <table class="table table-striped">
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

    <!-- Add Tool Modal -->
  <div class="modal fade" id="addToolModal" tabindex="-1" aria-labelledby="addToolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addToolModalLabel">Tambah Peralatan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" class="form-control" id="name">
            </div>
            <div class="mb-3">
              <label for="serial_number" class="form-label">Nomor Seri</label>
              <input type="text" class="form-control" id="serial_number">
            </div>
            <div class="mb-3">
              <label for="function" class="form-label">Fungsi</label>
              <textarea class="form-control" id="function" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="brand" class="form-label">Merek</label>
              <input type="text" class="form-control" id="brand">
            </div>
            <div class="mb-3">
              <label for="serial_type" class="form-label">Tipe Seri</label>
              <input type="text" class="form-control" id="serial_type">
            </div>
            <div class="mb-3">
              <label for="purchase_date" class="form-label">Tanggal Pembelian</label>
              <input type="date" class="form-control" id="purchase_date">
            </div>
            <div class="mb-3">
              <label for="technical_specification" class="form-label">Spesifikasi Teknis</label>
              <textarea class="form-control" id="technical_specification" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="factory_id" class="form-label">Pabrik</label>
              <select class="form-select" id="factory_id">
                <option selected disabled>Pilih Pabrik</option>
                <option value="1">Pabrik A</option>
                <option value="2">Pabrik B</option>
                <!-- Add more options if needed -->
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')

</script>
@endsection
