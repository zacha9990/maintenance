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
                <form action="{{ route('reports.generateForm', $builder['slug']) }}" method="POST">
                    @csrf

                    @foreach ($builder['input'] as $input)
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">{{ $input['text'] }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="{{ $input['id'] }}" name="{{ $input['id'] }}">
                            </div>
                        </div>
                    @endforeach


                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
         var getFactoryByIdRoute = '/api/factories/';
    </script>
    <script src="{{ asset('js/page/report.js') }}"></script>
@endsection
