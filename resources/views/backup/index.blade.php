@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body bg-dark">
                <form action="{{ route('backup.create') }}" method="GET">
                @csrf
                <button class="btn btn-primary" type="submit">Backup and Download</button>
            </form>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
   
@endsection
