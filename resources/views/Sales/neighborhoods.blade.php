<option value="0">Seleccione</option>
@foreach($neighborhoods as $neighborhood)
    <option value="{{ $neighborhood->neighborhood_id }}">{{ $neighborhood->name }}</option>
@endforeach


