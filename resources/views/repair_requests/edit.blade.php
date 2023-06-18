@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Repair Request
            </div>
            <div class="card-body">
                <form action="{{ route('repair_requests.update', $repairRequest->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="staff_id" class="form-label">Staff</label>
                        <select class="form-control" id="staff_id" name="staff_id" required>
                            <option value="">Select Staff</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ $staff->id == $repairRequest->staff_id ? 'selected' : '' }}>
                                    {{ $staff->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tool_id" class="form-label">Tool</label>
                        <select class="form-control" id="tool_id" name="tool_id" required>
                            <option value="">Select Tool</option>
                            @foreach ($tools as $tool)
                                <option value="{{ $tool->id }}" {{ $tool->id == $repairRequest->tool_id ? 'selected' : '' }}>
                                    {{ $tool->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $repairRequest->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('repair_requests.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
