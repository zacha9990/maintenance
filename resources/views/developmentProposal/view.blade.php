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
                                <a href="{{ route('developmentProposal.index') }}" class="btn btn-primary"> <i
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
                                            <th>Nama Pemohon</th>
                                            <td>{{ $developmentProposal->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $developmentProposal->address }}
                                                {{ $developmentProposal->district_id }}
                                                {{ $developmentProposal->village_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Telepon</th>
                                            <td>{{ $developmentProposal->phone_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun</th>
                                            <td>{{ $developmentProposal->data_year }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Usulan</th>
                                            <td>{{ $developmentProposal->proposal_type }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Proposal</th>
                                            <td>
                                                <a href="{{ Storage::url($developmentProposal->proposal_file) }}"
                                                    class="btn btn-secondary" target="_blank"><i class="fa fa-download"></i>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Surat Pengantar Desa</th>
                                            <td>
                                                <a href="{{ Storage::url($developmentProposal->village_chief_letter) }}"
                                                    class="btn btn-secondary" target="_blank"><i class="fa fa-download"></i>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($developmentProposal->status == 0)
                                                    <span class="badge rounded-pill bg-warning text-dark">Diproses</span>
                                                @elseif ($developmentProposal->status == 1)
                                                    <span class="badge rounded-pill bg-success">Disetujui</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                        </tr>

                                        @if($developmentProposal->status == 99)
                                        <tr>
                                            <th>Alasan Tolak</th>
                                            <td>
                                               {{ $developmentProposal->reject_reason }}
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        @if (Auth::user()->hasRole(['Admin','SuperAdmin']))
                            @if ($developmentProposal->status == 0)
                                <div class="text-center mb-5">
                                    <a href="{{ route('developmentProposal.confirm', [$developmentProposal->id, 'accept']) }}"
                                        class="btn btn-primary" onclick="return confirm('Anda Yakin?')">Terima</a>
                                        <a href="" data-bs-toggle="modal"
                                        data-bs-target="#modal-tolak"
                                            class="btn btn-danger">Tolak</a>
                                </div>
                            @endif
                        @endif
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
                 <form action="{{ route('developmentProposal.reject', $developmentProposal->id) }}" method="POST" id="reject-form">
                     @csrf
                     <div class="mb-3">
                         <label for="reject_reason" class="form-label">Alasan Tolak</label>
                         <textarea class="form-control" name="reject_reason" id="reject_reason" cols="30" rows="10"></textarea>
                     </div>
             </div>
             <div class="modal-footer">
                 <button type="submit" class="btn btn-primary" id="sa_save">Simpan</button>
                 <a href="{{ route('developmentProposal.show', $developmentProposal->id) }}" class="btn btn-secondary">Keluar</a>
             </div>
             </form>
         </div>
     </div>
 </div>
@endsection

@section('scripts')
    <script>
        var longitude = {{ $developmentProposal->longitude }};
        var latitude = {{ $developmentProposal->latitude }};
    </script>
    <script src="{{ asset('assets/js/pages/shared/googlemap.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
