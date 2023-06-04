<!-- Include Bootstrap CSS -->
@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="container mt-4">
                    <h2>Buat SparePart</h2>

                    <form id="create-sparepart-form" action="{{ route('spareparts.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="sparepart_name" class="col-sm-2 col-form-label">Nama:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sparepart_name" name="sparepart_name" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sparepart_quantity" class="col-sm-2 col-form-label">Kuantitas:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="sparepart_quantity" name="sparepart_quantity" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sparepart_availability" class="col-sm-2 col-form-label">Ketersediaan:</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="sparepart_availability" name="sparepart_availability" required>
                                    <option value="Habis">Habis</option>
                                    <option value="Tersedia">Tersedia</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Membuat Baru</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#create-sparepart-form').submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(response) {
                    if (response.success) {
                        alert('Sparepart created successfully');
                        window.location.href = "{{ route('spareparts.index') }}";
                    }
                }
            });
        });
    });
</script>
@endsection
