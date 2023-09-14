@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Pilih Dokumen</label>
                        <input type="file" name="file" class="form-control" required>
                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="category">Jenis Laporan</label>
                        <select name="category" class="form-control" required>
                          <option value="">Semua Laporan</option>
                            @foreach (config('reports') as $key => $category)
                                <option value="{{ $key }}"
                                    {{ request('category') === $key ? 'selected' : '' }}>{{ $category['name'] }}</option>
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label for="category">Pabrik</label>
                        <select name="factory_id" id="factory_id" class="form-control">
                            <option value="">Semua Pabrik</option>
                            @foreach ($factories as $factory)
                                <option value="{{ $factory->id }}"
                                    {{ request('factory') == $factory->id ? 'selected' : '' }}>{{ $factory->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('factory_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Upload</button>
                </form>

                 @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
