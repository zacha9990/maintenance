@extends('layouts.admin')

@section('css-after-bootstrap')
    <style>
        .nowrap-zone {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h1 class="mt-4">Daftar Peralatan Pabrik</h1>
            <div class="table-responsive">

                <table id="tools-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nomor seri</th>
                            <th>Fungsi</th>
                            <th>Merek</th>
                            <th>Jenis serial</th>
                            <th>Tanggal Pembelian</th>
                            <th>Spesifikasi teknis</th>
                            <th style="white-space:nowrap">Info</th>
                        </tr>
                    </thead>
                </table>

            </div>

        </div>
    </div>

    <!-- Modal for Spareparts -->
    <div id="spareparts-modal" class="modal fade" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Spareparts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table" id="spareparts-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Spareparts data will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Maintenance Period -->
    <div id="maintenance-modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Periode Perawatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="maintenance-table">
                        <thead>
                            <tr>
                                <th>Period</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Maintenance Period data will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tools-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('factories.toolList', $factory->id) }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'serial_number',
                        name: 'serial_number'
                    },
                    {
                        data: 'function',
                        name: 'function'
                    },
                    {
                        data: 'brand',
                        name: 'brand'
                    },
                    {
                        data: 'serial_type',
                        name: 'serial_type'
                    },
                    {
                        data: 'purchase_date',
                        name: 'purchase_date'
                    },
                    {
                        data: 'technical_specification',
                        name: 'technical_specification'
                    },
                    {
                        data: 'information_buttons',
                        name: 'information_buttons',
                        orderable: false,
                        searchable: false,
                        className: 'nowrap-zone'
                    },
                ]
            });

            $('#factory-filter').on('change', function() {
                var factoryId = $(this).val();

                // Refresh the DataTable with the new factory filter
                $('#tools-table').DataTable().ajax.url("{{ route('tools.list') }}?factory_id=" + factoryId)
                    .load();
            });

            // Handle click event for Spareparts button
            $('#tools-table').on('click', '.btn-spareparts', function() {
                var toolId = $(this).data('tool-id');

                // Fetch and display spareparts for the selected tool using AJAX
                $.ajax({
                    url: '/tools/' + toolId + '/spareparts',
                    method: 'GET',
                    success: function(response) {
                        // $('#spareparts-modal').modal('show');
                        var spareparts = response.data;

                        // Populate the spareparts table with the retrieved data
                        var tableBody = $('#spareparts-table tbody');
                        tableBody.empty();
                        spareparts.forEach(function(sparepart) {
                            var row = '<tr>' +
                                '<td>' + sparepart.sparepart_name + '</td>' +
                                '<td>' + sparepart.sparepart_quantity + '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });

                        // Show the "spareparts-modal"
                        $('#spareparts-modal').css('display', 'block');
                    }
                });
            });

            // Handle click event for Maintenance Period button
            $('#tools-table').on('click', '.btn-maintenance', function() {
                var toolId = $(this).data('tool-id');

                // Fetch and display maintenance period for the selected tool using AJAX
                $.ajax({
                    url: '/tools/' + toolId + '/maintenance',
                    method: 'GET',
                    success: function(response) {
                        var maintenancePeriods = response.data;

                        // Populate the maintenance period table with the retrieved data
                        var tableBody = $('#maintenance-table tbody');
                        tableBody.empty();
                        maintenancePeriods.forEach(function(period) {
                            var row = '<tr>' +
                                '<td>' + period.maintenance_period + '</td>' +
                                '<td>' + period.maintenance_type + '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });

                        // Show the "maintenance-modal"
                        $('#maintenance-modal').css('display', 'block');
                    }
                });
            });

            // Close the modals when the close button is clicked
            $('.modal .close').on('click', function() {
                $(this).closest('.modal').css('display', 'none');
            });
        });
    </script>
@endsection
