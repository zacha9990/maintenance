<!-- Include Bootstrap CSS -->
@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="container mt-4">
                    <h2>Buat SparePart</h2>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form id="create-sparepart-form" action="{{ route('spareparts.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="factory_id" class="col-sm-2 col-form-label">Pabrik</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="factory_id" name="factory_id" required>
                                    @foreach ($factories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sparepart_name" class="col-sm-2 col-form-label">Nama:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sparepart_name" name="sparepart_name"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-sm-2 col-form-label">Kuantitas:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    required>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Membuat Baru</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
