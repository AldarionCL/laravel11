<div class="w-100 ">
    <div id="alert-border-1" class="p-2 mb-4 text-gray-900 border-t-4 shadow-md border-green-300 bg-green-50" role="alert">
        <div class="text-sm">
            <p class="font-bold">Datos Resueltos:</p>
            @if($tarea)
                <div class="flex flex-wrap w-full">
                    @foreach($tarea->Datos as $datos)
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4">
                            <div class="border border-light mb-3 p-2 border-gray-300">
                                <label
                                    class="border-b-2 border-blue-300 block mb-2 text-sm font-medium text-gray-900">{{@$datos->Campos->Campo}}</label>
                                <div class=" mr-2">{{$datos->Valor}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No hay datos en la tarea</p>
            @endif
        </div>
    </div>

    <div id="alert-border-1" class="p-2 mb-4 text-gray-900 border-t-4 shadow-md border-green-300 bg-green-50" role="alert">
        <div class="text-sm">
            <p class="font-bold">Archivos subidos:</p>
            @if($tarea)
                <div class="flex flex-wrap w-full">
                    @foreach($tarea->Archivos as $datos)
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4">
                            <div class="border border-light mb-3 p-2 border-gray-300">
                                <label
                                    class="border-b-2 border-blue-300 block mb-2 text-sm font-medium text-gray-900">{{$datos->inputName}}</label>
                                <div class=" mr-2"><span class="fa fa-paperclip"> </span> <a href="{{'/storage/'.$datos->path}}" target="_blank"> {{$datos->name}}</a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No hay datos en la tarea</p>
            @endif
        </div>
    </div>
</div>

