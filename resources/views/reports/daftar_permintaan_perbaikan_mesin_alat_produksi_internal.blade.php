@extends('layouts.admin')

@section('css-after-bootstrap')

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
                                <input 
                                        class="form-control" 
                                        type="text" 
                                        id="{{ $input['id'] }}" 
                                        name="{{ $input['id'] }}" 
                                        @if ($input['id'] == "no_laporan") value="{{ $builder['no_laporan'] }}" readonly @endif
                                        required>
                            </div>
                        </div>
                    @endforeach

                    <div class="row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Pabrik</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="factory_id" name="factory_id">
                                @foreach ($builder['factories'] as $factory)
                                <option value="{{ $factory->id}}">{{ $factory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="date_start" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" id="date_start" name="date_start">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="date_end" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" id="date_end" name="date_end">
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
<script>
        document.addEventListener('DOMContentLoaded', function() {
        var dateStartInput = document.getElementById('date_start');
        var dateEndInput = document.getElementById('date_end');

        // Mendapatkan tanggal awal bulan saat ini
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var formattedFirstDay = firstDayOfMonth.toISOString().split('T')[0]; // Format ISO string ke 'yyyy-mm-dd'

        // Mengatur nilai default dan maksimum pada input date
        dateStartInput.value = formattedFirstDay;
        dateEndInput.value = today.toISOString().split('T')[0]; // Mengatur nilai maksimum menjadi hari ini

        // Mengatur atribut 'max' pada input date
        dateStartInput.setAttribute('max', today.toISOString().split('T')[0]);
        dateEndInput.setAttribute('max', today.toISOString().split('T')[0]);
    });
</script>
<script>
     var getFactoryByIdRoute = '/api/factories/';
</script>
<script src="{{ asset('js/page/report.js') }}"></script>

@endsection
