@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>All Maintenances</h1>
                <table id="maintenances-table" class="table">
                    <thead>
                        <tr>
                            <th>Tool Name</th>
                            <th>Scheduled Date</th>
                            <th>Status</th>
                            <th>Assign Date</th>
                            <th>Start Date</th>
                            <th>Completed Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $('#maintenances-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('maintenances.data') }}",
                columns: [{
                        data: 'tool_name',
                        name: 'tool_name'
                    },
                    {
                        data: 'scheduled_date',
                        name: 'scheduled_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'assign_date',
                        name: 'assign_date'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'completed_date',
                        name: 'completed_date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });


        });
    </script>
@endsection
