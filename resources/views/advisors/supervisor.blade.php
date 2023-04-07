@foreach($supervisors as $supervisor) 
    <div class="w-75 pt-4 pl-2 ml-2">
        <input class="text-center form-control" value="{{ $supervisor->name_supervisors }} {{$supervisor->lastname_supervisors }}"/>
    </div>
@endforeach