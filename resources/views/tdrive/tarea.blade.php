<x-app-layout>

    <livewire:tdrive.indicadores.semaforo-tdrive : idTdrive="{{$tdrive->ID}}"/>

    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">

                            <div class="flex flex-wrap items-center">
                                <div class="w-full sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3">
                                    <span class="fa fa-folder-open" aria-hidden="true"></span> TDRIVE OT:
                                    <strong>{{$tdrive->Ot_principal}}</strong>
                                </div>
                                <div class="w-full sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3">
                                    <span class="fa fa-car" aria-hidden="true"></span> Patente:
                                    <strong>{{$tdrive->Patente}}</strong>
                                </div>
                                <div class="w-full sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3">
                                    <span class="fa fa-wrench" aria-hidden="true"></span> N° Siniestro:
                                    <strong>{{$tdrive->NumeroSiniestro}}</strong>
                                </div>
                            </div>
                            {{--Estado del flujo--}}
                            <div id="alert-border-1"
                                 class=" p-2 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800"
                                 role="alert">
                                <div class="flex flex-wrap">
                                    <div class="w-full p-2  sm:w-1/1 md:w-1/2 lg:w-1/3 xl:w-1/3 text-sm font-medium">
                                        Fecha tarea: <strong>{{date('Y-m-d H:i',strtotime($tarea->created_at))}}</strong>
                                    </div>
                                    <div class="sm:w-1/2 md:w-1/4 lg:w-1/3 xl:w-1/3 text-sm font-medium">
                                        Fecha de egreso: <br><strong>{{($tdrive->FechaEntrega != null) ? $tdrive->FechaEntrega : $tdrive->FechaEstimadaEntrega}}</strong>
                                    </div>
                                    <div class="sm:w-1/2 md:w-1/4 lg:w-1/3 xl:w-1/3 text-sm font-medium">
                                        Tiempo de flujo: <br><strong>{{textoMinutos(MinutosEntreFechas(($tdrive->FechaEntrega != null)?$tdrive->FechaEntrega : date('Y-m-d H:i:s'),$tdrive->created_at),false)}}</strong>
                                    </div>
                                </div>
                            </div>


                            {{--Formulario tarea--}}
                            <div class="flex flex-wrap p-2 rounded-lg border border-1 border-blue-200 p-2  items-center mb-4 text-gray-900 border-blue-300  dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800">
                                <div class="mb-3 w-full border-b-4 border-blue-300 dark:border-blue-800">
                                    <div class="text-md text-gray-700 dark:text-white">
                                        <strong>{{$tarea->Tipo->NombreTarea}}</strong></div>
                                    <div
                                        class="text-xs text-gray-700 dark:text-white p-2">{{@$tarea->Tipo->Descripcion}}</div>
                                </div>

                                <div class="mb-3 w-full sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3">
                                    <div class="text-md text-gray-700 dark:text-white">
                                        <strong>Estado:</strong><br> <span class="text-xs p-2 text-xs rounded-1.8 inline-block whitespace-nowrap text-center bg-gradient-to-tl {{$colorEstado}} align-baseline font-bold leading-none text-white">{{$tarea->Estado}}</span>
                                        @if(esAdminTdrive())
                                            @if($tarea->Estado == 'Rechazado' || $tarea->Estado == 'Resuelto')
                                                <button type="button" class="reabrir text-xs text-green-500">
                                                   <small> <span class="fa fa-reply" aria-hidden="true">Reabrir</span></small>
                                                </button>
                                            @endif

                                                <button type="button" class="eliminar text-xs text-red-500">
                                                    <small><span class="fa fa-window-close" aria-hidden="true"> Eliminar</span></small>
                                                </button>
                                        @endif

                                        @if($tarea->Estado == 'Postergado')
                                            <a href="{{route('despostergartarea',[$tarea->ID])}}" class="text-xs text-green-500">
                                                <span class="fa fa-reply" aria-hidden="true"></span>
                                            </a>
                                        @endif

                                    </div>
                                </div>
                                <div class="mb-3 pl-2 w-full sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3">
                                    <div class="text-md text-gray-700 dark:text-white"><strong>SLA:</strong><br>
                                        <span class="text-xs">
                                        @if($tarea->Tipo->sla_invertido == 1)
                                                <span class="fa fa-arrow-circle-right text-cyan-500"> </span> {{textoMinutos(MinutosEntreFechas((($tarea->FechaResolucion)? $tarea->FechaResolucion : date('Y-m-d H:i:s')),$tarea->created_at))}}
                                            @elseif($tarea->Estado == 'Postergado')
                                                <small class="">Tiempo suspendido</small>
                                                <br>
                                                <small>Postergado a : {{$tarea->FechaPostergacion}}</small>
                                            @elseif($tarea->CumpleSla === 1)
                                                <span class="fa fa-check text-success text-green-500"> </span> Resuelto en tiempo
                                            @elseif($tarea->CumpleSla === 0)
                                                <span class="fa fa-hourglass-3 text-orange-500"> </span> Resuelto fuera de
                                                tiempo
                                            @elseif($tarea->CumpleSla === null)
                                                <span
                                                    class="fa fa-clock {{(textoSla($tarea->FechaSla, date('Y-m-d H:i:s'))=='Excedido') ? 'text-danger' : 'text-success'}}">  {{textoSla($tarea->FechaSla, date('Y-m-d H:i:s'))}}</span>
                                            @endif
                                        </span>

                                    </div>
                                </div>
                                <div class="mb-3 w-full sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3">
                                    <div class="text-md text-gray-700 dark:text-white">
                                        <strong >Responsable:</strong><br>
                                        <span class="text-xs">
                                            @if(esAdminTdrive())
                                            <select id="responsableSelect" name="responsableSelect" class="focus:shadow-primary-outline text-xs leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                <option value="">Sin responsable</option>
                                                @foreach($responsables as $responsable)
                                                    <option {{(@$tarea->Responsable->ID == $responsable["ID"]) ? 'selected' : ''}} value="{{$responsable["ID"]}}">{{$responsable["Email"]}}</option>
                                                @endforeach
                                            </select>
                                            @else
                                                {{(@$tarea->Responsable->Nombre !== null)? @$tarea->Responsable->Nombre : 'Sin info'}}
                                            @endif
                                        </span>
                                    </div>
                                </div>


                                {{--datos tarea anterior--}}
                                <div class="w-full w-100">
                                    <div id="alert-border-1"
                                         class="p-2 mb-4 text-gray-900 border-t-4 shadow-md border-gray-300 bg-gray-50 dark:text-gray-400 dark:bg-blue-950 dark:border-blue-900"
                                         role="alert">
                                        <livewire:tdrive.componentes.tareas.referencia : idTarea="{{$tarea->ID}}"/>
                                    </div>
                                </div>

                                <div class="w-full w-100">
                                    @if($tarea->Estado == 'Abierto')
                                        @include('livewire.tdrive.componentes.tareas.formulario')
                                        {{-- <livewire:tdrive.componentes.tareas.formulario : idTarea="{{$tarea->ID}}"/>--}}
                                    @else
                                        <livewire:tdrive.componentes.tareas.resuelto : idTarea="{{$tarea->ID}}"/>
                                    @endif

                                </div>
                            </div>

                            {{--footer--}}
                            <livewire:tdrive.componentes.footer-flujo : idTdrive="{{$tdrive->ID}}"/>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#responsableSelect').on('change', function (){

        Swal.fire({
            icon: 'question',
            title: 'Quiere reasignar al responsable seleccionado?',
            text: 'El usuario seleccionado pasará a ser el responsable de la tarea',
            showCancelButton: true,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                let data = {
                    'idTarea': '{{@$tarea->ID}}',
                    'idResponsable': $('#responsableSelect').val()
                };

                $.ajax({
                    url: '{{route('reasignarResponsable')}}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (result) {
                        Swal.fire(result.mensaje, '', 'info');
                    }
                });
            }
        });

    });



    $('.reabrir').on('click', function (){

        Swal.fire({
            icon: 'question',
            title: 'Quiere reabrir la tarea?',
            text: 'Si reabre la tarea, al resolverla generará la siguiente tarea del flujo, pudiendo provocar duplicaciones de flujos.',
            showCancelButton: true,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                let data = {
                    'idTarea': '{{@$tarea->ID}}',
                    'idResponsable': $('#responsableSelect').val()
                };

                $.ajax({
                    url: '{{route('reabrirtarea',[$tarea->ID])}}',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (result) {
                        location.reload();
                    }
                });
            }
        });

    });


    $('.eliminar').on('click', function (){
        let urlAtras = '{{route('flujotdrive',[$tarea->TdriveID])}}';

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
