@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="container mt-4">
                    <h2>Edit SparePart Quantity</h2>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <form id="edit-sparepart-form" action="{{ route('spareparts.update', $sparepart->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="sparepart_name" class="col-sm-2 col-form-label">SparePart:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sparepart_name" name="sparepart_name"
                                    value="{{ $sparepart->sparepart_name }}" readonly>
                            </div>
                        </div>

                        @foreach ($factories as $factory)
                            <div class="row mb-3">
                                <label for="quantity_{{ $factory->id }}" class="col-sm-2 col-form-label">{{ $factory->name }} Quantity:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity_{{ $factory->id }}"
                                        name="quantity[{{ $factory->id }}]" value="{{ $factory->spareparts->find($sparepart->id)->pivot->quantity ?? 0 }}" required>
                                </div>
                            </div>
                        @endforeach

                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Update Quantity</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
