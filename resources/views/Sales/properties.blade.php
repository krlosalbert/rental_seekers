<option value="0">Seleccione</option>
@foreach($properties as $property)
    <option value="{{ $property->id }}">{{ $property->name }}</option>
@endforeach


