@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Maintenance Criteria</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('maintenance-criterias.update', $maintenanceCriteria->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($toolCategories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $maintenanceCriteria->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="criteria-fields">
                            @foreach ($maintenanceCriteria->criteria as $criteria)
                            <input type="hidden" name="tool_category[]" value="{{ $criteria->id }}">
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name[]" placeholder="Nama" value="{{ $criteria->name }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description[]" placeholder="Deskripsi">{{ $criteria->description }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="button" class="btn btn-primary" id="add-criteria-btn">Tambah Kriteria</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('maintenance-criterias.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var criteriaFields = $('#criteria-fields');

        $('#add-criteria-btn').click(function() {
            var newField = `
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name[]" placeholder="Nama" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description[]" placeholder="Deskripsi"></textarea>
                    </div>
                </div>
            `;
            criteriaFields.append(newField);
        });
    });
</script>
@endsection
