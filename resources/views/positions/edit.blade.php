@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="mt-4">Edit Position</h1>
            <form action="{{ route('positions.update', $position->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="role_id" name="role_id">
                            @foreach ($roles as $roleId => $roleName)
                                <option value="{{ $roleId }}" {{ $position->role_id == $roleId ? 'selected' : '' }}>{{ $roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize X-editable
            $('#role_id').editable({
                source: [
                    @foreach ($roles as $roleId => $roleName)
                        {value: {{ $roleId }}, text: '{{ $roleName }}'},
                    @endforeach
                ],
                success: function(response, newValue) {
                    if (response && response.success) {
                        toastr.success(response.success);
                    } else {
                        toastr.error('An error occurred.');
                    }
                }
            });
        });
    </script>
@endsection
