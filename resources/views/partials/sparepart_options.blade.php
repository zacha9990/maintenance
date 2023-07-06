@foreach ($spareparts as $sparepart)
    <option value="{{ $sparepart->id }}">{{ $sparepart->sparepart_name }}</option>
@endforeach
