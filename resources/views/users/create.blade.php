@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Buat Pengguna</h1>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Surel</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="contact" class="col-sm-2 col-form-label">Kontak</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="contact" name="contact" value="{{ old('contact') }}">
                            @error('contact')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Kata sandi</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" id="password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">konfirmasi sandi</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="position" class="col-sm-2 col-form-label">Posisi</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="position" name="position">
                                <option value="">Select Position</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
