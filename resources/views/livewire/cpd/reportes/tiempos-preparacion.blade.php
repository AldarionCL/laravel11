<div class="flex flex-row w-full gap-1 border-2 border-gray-300 p-2 rounded-lg content-start text-xs-center text-white overflow-auto">
    @foreach($pasos as  $paso)
    <div class="" style="min-width: 125px; width: 100%; z-index: 3; align-content: center; text-align: center">
        <div class="{{$estados[$paso->Tipo]}} border-2 border-blue-500 rounded-lg p-1 shadow-md mb-3">
            <div class="text-center items-center m-0">
                <span class=" fa {{$iconos[$paso->Tipo]}} "></span>
                <br><small><small>{{$paso->NombreTarea}}</small></small>
                <br>
                <div class=" p-1 px-2.5 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gray-50 align-baseline font-bold uppercase leading-none text-gray-500"><span class="text-2xs "></span> {{(isset($cantidades[$paso->ID])) ? $cantidades[$paso->ID] : 0}} </div>
            </div>
        </div>
        @if(isset($arrayCasos[$paso->ID]))
            @foreach($arrayCasos[$paso->ID] as $caso)
                <a href="{{route('flujocpd',[$caso["ID"]])}}">
                    <div class="border-{{$caso["color"]}}-500 bg-gray-100 mt-2 text-xs text-gray-600 border-2  rounded-lg p-1 basis-1/9 shadow-md" style="font-size: 8px; max-width: 100px; text-align: center; margin: 0 auto;  margin-bottom: 10px;">

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


