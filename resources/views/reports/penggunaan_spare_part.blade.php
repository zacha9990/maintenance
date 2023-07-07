@extends('layouts.admin')

@section('css-after-bootstrap')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Masukkan data-data berikut sebelum mulai mencetak laporan
            </div>
            <div class="card-body">
                <div class="row mb-3 text-center">
                    <h4>{{ $builder['name'] }}</h4>
                </div>
                <form action="{{ route('reports.generateForm', $builder['slug']) }}" method="POST">
                    @csrf

                    @foreach ($builder['input'] as $input)
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">{{ $input['text'] }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="{{ $input['id'] }}"
                                    name="{{ $input['id'] }}"
                                    @if ($input['id'] == 'no_laporan') value="{{ $builder['no_laporan'] }}" readonly @endif
                                    required>
                            </div>
                        </div>
                    @endforeach

                    <div class="row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Pabrik</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="factory_id" name="factory_id">
                                @foreach ($builder['factories'] as $factory)
                                    <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="spareparts" class="col-sm-2 col-form-label">Sparepart</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" id="spareparts" name="spareparts[]" multiple required>

                            </select>
                            <small class="text-muted">Jika sparepart tidak tercantum, silakan <a
                                    href="{{ route('spareparts.create') }}">buat baru</a>.</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" id="tanggal" name="tanggal">
                        </div>
                    </div>
                    <button type="submit" name="action" value="print" class="btn btn-primary">Cetak</button>
                    <button type="submit" name="action" value="preview" class="btn btn-info">Preview</button>
                    <a href="{{ route('reports.index') }}" class="btn btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('#factory_id').on('change', function() {
                var factoryId = $(this).val();

                if (factoryId) {
                    $.ajax({
                        url: "{{ route('factories.getSpareparts') }}",
                        type: "GET",
                        data: {
                            factory_id: factoryId
                        },
                        success: function(data) {
                            $('#spareparts').html(data);
                        }
                    });
                } else {
                    $('#spareparts').html(
                        '<option value="" disabled>Pilih Pabrik terlebih dahulu</option>');
                }
            });
        });
    </script>
@endsection
