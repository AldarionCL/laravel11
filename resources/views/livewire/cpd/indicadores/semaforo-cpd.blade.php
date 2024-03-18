<div class="flex flex-row gap-1 rounded-lg content-start text-xs-center text-white overflow-auto">
    @foreach($pasos as  $paso)
        <div class="{{$estados[$paso->Orden]}} border-2 border-blue-500 rounded-lg p-2  shadow-md text-sm   " style="min-width: 80px; width:100%; z-index: 3;">
            <p class="text-center items-center m-0">
                <span class=" fa {{$iconos[$paso->Orden]}} ">{{--{{$paso->Orden}}--}}</span>
            <br><small><small>{{$paso->Paso}}</small></small></p>
        </div>
    @endforeach
</div>
