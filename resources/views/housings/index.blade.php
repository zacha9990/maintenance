@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Data Rumah</h4>
                        <p class="card-title-desc">Data {{ $title }} Kabupaten Mukomuko</p>

                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('housings.create', ['jenis' => $jenis]) }}"
                                    class="btn btn-primary waves-effect waves-light mb-3">Tambah Data</a>
                            </div>
                            <div class="col-4">
                                <select class="form-select" aria-label="Default select example" id="district_id">
                                    <option selected value="0">Semua Kecamatan</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 d-flex justify-content-between">
                                <a href="" id="btn-filter"
                                    class="btn btn-primary waves-effect waves-light mb-3">Filter</a>
                                <a href="" id="btn-export"
                                    class="btn btn-primary waves-effect waves-light mb-3">Cetak Data</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="housing-table">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Perumahan</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        var routeHouse = "{{ route('housings.list.jenis', $jenis) }}";
    </script>
    <script>
        $(function() {

            $('#btn-filter').on('click', function(e) {
                e.preventDefault();
                $('#housing-table').DataTable().draw();
            })

            $('#btn-export').on('click', function(e) {
                var fileName = 'Export Perumahan.xlsx';
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    data: {
                        type: "{{ $jenis }}",
                        distric_id: $('#district_id').val()
                    },
                    xhr: function() {
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 2) {
                                if (xhr.status == 200) {
                                    xhr.responseType = "blob";
                                } else {
                                    xhr.responseType = "text";
                                }
                            }
                        };
                        return xhr;
                    },
                    url: "{{ route('housings.export') }}",
                    success: function(data) {
                        var blob = new Blob([data], {
                            type: "application/octetstream"
                        });

                        //Check the Browser type and download the File.
                        var isIE = false || !!document.documentMode;
                        if (isIE) {
                            window.navigator.msSaveBlob(blob, fileName);
                        } else {
                            var url = window.URL || window.webkitURL;
                            link = url.createObjectURL(blob);
                            var a = $("<a />");
                            a.attr("download", fileName);
                            a.attr("href", link);
                            $("body").append(a);
                            a[0].click();
                            $("body").remove(a);
                        }
                    }
                });
            })

            $('#housing-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: routeHouse,
                    data: function(d) {
                        d.district_id = $('#district_id').val();
                    }
                },
                columns: [{
                        data: 'rownum',
                        name: 'rownum'
                    },
                    {
                        data: 'house_name',
                        name: 'house_name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#housing-table').on('click', '.btn-delete[data-remote]', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var url = $(this).data('remote');
                console.log(url);
                // confirm then
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        method: '_DELETE',
                        submit: true
                    }
                }).always(function(data) {
                    $('#housing-table').DataTable().draw(false);
                });
            })
        });
    </script>
@endsection
