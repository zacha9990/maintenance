@extends('layouts.admin')


@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h1>Detail Pengguna</h1>

            <table class="table table-bordered">
                <tr>
                    <th>Nama:</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Kontak:</th>
                    <td>{{ $user->contact }}</td>
                </tr>
                <tr>
                    <th>Position:</th>
                    <td>{{ $user->staff->position->name }}</td>
                </tr>
            </table>


        </div>
    </div>
</div>
@endsection
