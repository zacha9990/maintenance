@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Edit User</h1>

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="factory_id" class="col-sm-2 col-form-label">Pabrik</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="factory_id" name="factory_id">
                                    <option value="">Tidak dalam pabrik tertentu</option>
                                @foreach ($factories as $factory)
                                    <option value="{{ $factory->id }}" {{ $user->staff->factory_id == $factory->id ? "selected" : "" }}>{{ $factory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="contact" class="col-sm-2 col-form-label">Kontak</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="contact" name="contact" value="{{ $user->contact }}">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="position_id" class="col-sm-2 col-form-label">Posisi</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="position_id" name="position_id" required>
                                @foreach ($positions as $positionId => $positionName)
                                    <option value="{{ $positionId }}" {{ $user->staff->position_id == $positionId ? 'selected' : '' }}>
                                        {{ $positionName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
