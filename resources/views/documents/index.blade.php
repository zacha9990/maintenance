@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">

            <div class="card-body">


                <form method="GET" action="{{ route('documents.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="category">Filter Jenis Laporan:</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Semua Laporan</option>
                                @foreach (config('reports') as $key => $category)
                                    <option value="{{ $key }}"
                                        {{ request('category') === $key ? 'selected' : '' }}>{{ $category['name'] }}</option>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="factory">Filter Pabrik:</label>
                            <select name="factory" id="factory" class="form-control">
                                <option value="">Semua Pabrik</option>
                                @foreach ($factories as $factory)
                                    <option value="{{ $factory->id }}"
                                        {{ request('factory') == $factory->id ? 'selected' : '' }}>{{ $factory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mt-4">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                        </div>
                        <div class="col-md-2 mt-4">
                            <a href="{{ route('documents.create') }}" class="btn btn-success">Upload Document</a>
                        </div>
                    </div>
                </form>
                <table class="table table-condensed table-stripped">
                    <thead>
                        <tr>
                            <th>Jenis Laporan</th>
                            <th>Nama File</th>
                            <th>Pabrik</th>
                            <th>Waktu Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ config('reports')[$document->category]['name'] }}</td>
                                <td>{{ $document->filename }}</td>
                                <td>{{ $document->factory->name }}</td>
                                <td>{{ $document->created_at }}</td>
                                <td>
                                    <a href="{{ route('documents.show', $document) }}" class="btn btn-primary">View</a>

                                    <form action="{{ route('documents.destroy', $document) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $documents->links() }} <!-- Display pagination links -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
