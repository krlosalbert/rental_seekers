@foreach($supervisors as $supervisor) 
    <div class="w-75 pt-4 pl-2 ml-2 bg-warning">
        <label><b>Supervisor</b></label>
        <input class="text-center form-control bg-warning" value="{{ $supervisor->name_supervisors }} {{$supervisor->lastname_supervisors }}"/>
    </div>
@endforeach