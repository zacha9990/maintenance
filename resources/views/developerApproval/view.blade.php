@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/css/pages/settlement_asset/create.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <a href="{{ route('developerApproval.index') }}" class="btn btn-primary"> <i
                                        class="ri-arrow-left-line"></i> </a>
                            </div>
                            <div class="col-11">
                                <h3 class="mb-3">View Data</h3>
                            </div>

                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <hr>
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <th>Nama Developer</th>
                                            <td>{{ $developerApproval->developer->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>No IMB</th>
                                            <td>{{ $developerApproval->imb }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Telepon</th>
                                            <td>{{ $developerApproval->phone_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($developerApproval->status == 0)
                                                    <span class="badge rounded-pill bg-warning">Diproses</span>
                                                @else
                                                    <span class="badge rounded-pill bg-success">Diterima</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Siteplan</th>
                                            <td>
                                                <a href="{{ Storage::url($developerApproval->site_plan) }}"
                                                    class="btn btn-secondary" target="_blank"><i class="fa fa-download"></i>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Document</th>
                                            <td>
                                                <a href="{{ Storage::url($developerApproval->documents->where('status', 0)->first()->path) }}"
                                                    class="btn btn-secondary" target="_blank"><i class="fa fa-download"></i>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                        @if ($developerApproval->documents->where('status', 1)->first())
                                            <tr>
                                                <th>Document Lainnya</th>
                                                <td>
                                                    <a href="{{ Storage::url($developerApproval->documents->where('status', 1)->first()->path) }}"
                                                        class="btn btn-secondary" target="_blank"><i
                                                            class="fa fa-download"></i>
                                                        Download
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">
                                <div id="map">

                                </div>
                            </div>

                            <tr>
                                <div class="col-12">
                                    @if (Auth::user()->hasRole(['Admin','SuperAdmin']))
                                        @if ($developerApproval->status == 0)
                                            <div class="text-center mb-5">
                                                <a href="{{ route('developerApproval.confirm', [$developerApproval->id, 'accept']) }}"
                                                    class="btn btn-primary"
                                                    onclick="return confirm('Anda Yakin?')">Terima</a>
                                                <a href="{{ route('developerApproval.confirm', [$developerApproval->id, 'reject']) }}"
                                                    class="btn btn-danger" onclick="return confirm('Anda Yakin?')">Tolak</a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </tr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade bs-example-modal-center" id="modal-tolak" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Alasan Tolak</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('developerApproval.reject', $developerApproval->id) }}" method="POST" id="reject-form">
                     @csrf
                     <div class="mb-3">
                         <label for="reject_reason" class="form-label">Alasan Tolak</label>
                         <textarea class="form-control" name="reject_reason" id="reject_reason" cols="30" rows="10"></textarea>
                     </div>
             </div>
             <div class="modal-footer">
                 <button type="submit" class="btn btn-primary" id="sa_save">Simpan</button>
                 <a href="{{ route('developerApproval.show', $developerApproval->id) }}" class="btn btn-secondary">Keluar</a>
             </div>
             </form>
         </div>
     </div>
 </div>
@endsection

@section('scripts')
    <script>
        var longitude = {{ $developerApproval->longitude }};
        var latitude = {{ $developerApproval->latitude }};
    </script>
    <script src="{{ asset('assets/js/pages/shared/googlemap.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
