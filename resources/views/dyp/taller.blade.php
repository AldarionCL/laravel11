<x-app-layout>

    <livewire:dyp.indicadores.semaforo-dyp : idDyp="{{$dyp->ID}}"/>

    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                <div class="px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">

                            <div class="flex flex-wrap items-center">
                                <div class="w-full sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3">
                                    <span class="fa fa-folder-open" aria-hidden="true"></span> DYP OT:
                                    <strong>{{$dyp->Ot_principal}}</strong>
                                </div>
                                <div class="w-full sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3">
                                    <span class="fa fa-car" aria-hidden="true"></span> Patente:
                                    <strong>{{$dyp->Patente}}</strong>
                                </div>
                                <div class="w-full sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3">
                                    <span class="fa fa-wrench" aria-hidden="true"></span> N° Siniestro:
                                    <strong>{{$dyp->NumeroSiniestro}}</strong>
                                </div>
                            </div>
                            {{--Estado del flujo--}}
                            <div id="alert-border-1"
                                 class=" p-2 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50"
                                 role="alert">
                                <div class="flex flex-wrap">

                                    <div class="w-full p-2  sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3 text-sm font-medium">
                                        Fecha Ingreso Taller: <strong>{{date('Y-m-d',strtotime($dyp->IngresoTaller))}}</strong>
                                    </div>
                                    <div class="w-full p-2  sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3 text-sm font-medium">
                                        Fecha de egreso: <strong>{{($dyp->EgresoTaller!= null)?date('Y-m-d',strtotime($dyp->EgresoTaller)):'-'}}</strong>
                                    </div>
                                    <div class="w-full p-2  sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3 text-sm font-medium">
                                        Fecha estimada de entrega: <strong>{{date('Y-m-d',strtotime($dyp->FechaEstimadaEntrega))}}</strong>
                                    </div>
                                </div>
                            </div>


                            {{--Formulario tarea--}}
                            <div class="flex flex-wrap p-2 rounded-lg border border-1 border-blue-200 p-2  items-center mb-4 text-gray-900 border-blue-300 ">
                                <div class="mb-3 w-full border-b-4 border-blue-300">
                                    <div class="text-md text-gray-700">
                                        <strong>{{$tarea->Tipo->NombreTarea}}</strong></div>
                                    <span class="inline-block">
                                        @if(esAdminDyp())
                                            <button type="button" class="eliminar text-xs text-red-500">
                                                <small><span class="fa fa-window-close" aria-hidden="true"> Eliminar</span></small>
                                            </button>
                                        @endif
                                    </span>


                                    <div
                                        class="text-xs text-gray-700 p-2">{{@$tarea->Tipo->Descripcion}}</div>
                                </div>

                                <div class="mb-3 pl-2 mr-5 w-auto " >
                                    <a href="javascript:imprSelec('divQR')" >{{($dyp->Vin!= null)?generarQR($dyp->Vin.'|'.$dyp->ID,100) : ''}}</a>
                                </div>

                                <div class="w-100  hidden" id="divQR">
                                    <p style="padding-left: 30px">{{($dyp->Vin!= null)?generarQR($dyp->Vin.'|'.$dyp->ID,100) : ''}}</p>
                                    <img src="{{asset('assets/img/Logo_Pompeyo.png')}}" width="300px">
                                </div>

                                <div class="mb-3 w-full sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4">
                                    <div class="text-md text-gray-700">
                                        <strong>Estado:</strong><br> <span class="text-xs">{{$tarea->Estado}}
                                            @if($tarea->Estado == 'Rechazado')
                                                <small><a href="{{route('reabrirtarea',[$tarea->ID])}}" class="mr-3 inline-block px-4 py-1.5 font-bold text-center bg-gradient-to-tl from-blue-500 to-violet-500 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white">
                                                        Reabrir
                                                    </a>
                                                </small>
                                            @endif
                                            @if($tarea->Estado == 'Postergado')
                                                <small><a href="{{route('despostergartarea',[$tarea->ID])}}"
                                                          class="btn-sm btn-warning">
                                                        Despostergar
                                                    </a>
                                                </small>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3 pl-2 w-full sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4">
                                    <div class="text-md text-gray-700"><strong>Tiempo en taller:</strong><br>
                                        <span class="text-xs">
                                        @if($tarea->Tipo->sla_invertido == 1)
                                                <span class="fa fa-arrow-circle-right text-cyan-500"> </span> {{textoMinutos(MinutosEntreFechas((($tarea->FechaResolucion)? $tarea->FechaResolucion : date('Y-m-d H:i:s')),$tarea->created_at))}}
                                            @elseif($tarea->Estado == 'Postergado')
                                                <small class="">Tiempo suspendido</small>
                                                <br>
                                                <small>Postergado a : {{$tarea->FechaPostergacion}}</small>
                                            @elseif($tarea->CumpleSla === 1)
                                                <span class="fa fa-check text-success"> </span> Resuelto en tiempo
                                            @elseif($tarea->CumpleSla === 0)
                                                <span class="fa fa-hourglass-3 text-danger"> </span> Resuelto fuera de tiempo
                                            @elseif($tarea->CumpleSla === null)
                                                <span
                                                    class="fa fa-clock {{(textoSla($tarea->FechaSla, date('Y-m-d H:i:s'))=='Excedido') ? 'text-danger' : 'text-success'}}">  {{textoSla($tarea->FechaSla, date('Y-m-d H:i:s'))}}</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-3 pl-2 w-full sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4">
                                    <div class="text-md text-gray-700"><strong>Trabajos estimados:</strong><br>
                                        <span class="text-xs">
                                            <ul class="list-disc pl-4">
                                                @foreach($tareaOrdenCIA->Datos as $tareaOrden)
                                                    @if(in_array($tareaOrden->Campos->InputName,$camposValores))
                                                    <li>{{$tareaOrden->Campos->Campo}}:  {{$tareaOrden->Valor}}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </span>
                                    </div>
                                </div>


                                {{--datos tarea anterior--}}
                                <div class="w-full w-100">
                                    <div id="alert-border-1"
                                         class="p-2 mb-4 text-gray-900 border-t-4 shadow-md border-gray-300 bg-gray-50"
                                         role="alert">

                                        <div class="text-sm text-gray-600">
                                            <p class="font-bold border-b-2">Información vehículo</p>
                                            <div class="flex flex-wrap w-100 w-full">
                                                <div class="w-auto p-4">
                                                    <h1><span class="fa fa-car text-size-xl" style="font-size: 60px"></span></h1>
                                                </div>
                                                <div class="ml-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4">
                                                    <ul class="list-disc">
                                                        <li><strong>Patente: </strong> {{$dyp->Patente}}</li>
                                                        <li><strong>Marca: </strong> {{@$dyp->Marca}}</li>
                                                        <li><strong>Modelo: </strong> {{@$dyp->Modelo}} {{$dyp->Versiont}}</li>
                                                        <li><strong>Color: </strong> {{@$dyp->Color}}</li>
                                                    </ul>
                                                </div>

                                                <div class="w-auto p-4">
                                                    <h1><span class="fa fa-wrench text-size-xl" style="font-size: 60px"></span></h1>
                                                </div>
                                                <div class="ml-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4">
                                                    <ul class="list-disc">
                                                        <li><strong>Magnitud daño: </strong> {{$dyp->Magnitud}}</li>
                                                        <li><strong>Cono: </strong> {{$dyp->Cono}}</li>
                                                        <li><strong>Ot principal: </strong> {{$dyp->Ot_principal}}</li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="w-full w-100">
                                    <livewire:dyp.componentes.tareas.formulario-taller : idTarea="{{$tarea->ID}}"/>
                                </div>
                            </div>

                            {{--footer--}}
                            <livewire:dyp.componentes.footer-flujo : idDyp="{{$dyp->ID}}"/>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $('.eliminar').on('click', function (){
        let urlAtras = '{{route('flujodyp',[$tarea->DypID])}}';

        Swal.fire({
            icon: 'question',
            title: 'Quiere eliminar la tarea?',
            text: 'Si elimina la tarea su flujo se detendrá, a menos que reabra la tarea anterior para continuar el flujo como corresponde.',
            showCancelButton: true,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                let data = {
                    'idTarea': '{{@$tarea->ID}}',
                    'idResponsable': $('#responsableSelect').val()
                };

                $.ajax({
                    url: '{{route('eliminartarea',[$tarea->ID])}}',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (result) {
                        window.location.href = urlAtras;
                    }
                });
            }
        });

    });
</script>

</x-app-layout>

