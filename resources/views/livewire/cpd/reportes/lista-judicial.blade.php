<div class="flex flex-row gap-1 border-2 border-gray-300 p-2 rounded-lg content-start text-xs-center text-white overflow-auto">
    @foreach($pasos as  $paso)
        <div class="" style="min-width: 105px; width: 100%; z-index: 3;">

            @if(isset($arrayCasos[$paso->Orden]))
                @foreach($arrayCasos[$paso->Orden] as $caso)
                    <a href="{{route('flujocpd',[$caso["ID"]])}}">
                        <div class="border-{{$caso["color"]}}-500 bg-gray-100 mt-2 text-xs text-gray-600 border-2  rounded-lg p-1 w-50 basis-1/9 shadow-md" style="font-size: 8px; max-width: 75px; margin-left:12px;">
                            <div class="text-center items-center m-0">
                                <div class="text-2xs">
                                    <div class=" p-1 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-{{$caso["color"]}}-500 align-baseline font-bold uppercase leading-none text-white"><span class="text-2xs fa fa-clock-o"></span> {{$caso["textotiempo"]}}</div>
                                </div>

                                <div class="font-bold" >{{$caso["NombreTarea"]}}</div>

                                <div class="bg-white border-2 border-gray-900 text-2xs font-bold ">{{formato_patente($caso["patente"])}}</div>
                                <br>
                                <div class="text-2xs">
                                    Tiempo total:
                                    <div class=" p-1 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gray-400 align-baseline font-bold uppercase leading-none text-white"><span class="text-2xs fa fa-hourglass-half"></span> {{$caso["tiempototal"]}}</div>
                                </div>

                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    @endforeach
    <button type="button" wire:click="$refresh">Update</button>
</div>


