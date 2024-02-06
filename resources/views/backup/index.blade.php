@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body bg-dark">
                <form action="{{ route('backup.create') }}" method="GET">
                @csrf
                <button class="btn btn-primary" type="submit">Backup and Download</button>
            </form>

            <h2>File List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Created At</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fileDetails as $file)
                       <tr>
                            <td>{{ $file['name'] }}</td>
                            <td>{{ \Carbon\Carbon::createFromTimestamp($file['created_at'])->toDateTimeString() }}</td>
                            <td><a href="{{ $file['download_link'] }}" class="btn btn-primary" download>Download</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
   
@endsection
