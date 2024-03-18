<form name="formTarea" action="{{route('completartareadyp',[$tarea->ID])}}" type="post" id="formTarea" class=" p-2 border border-gray-200 rounded-lg m-0 shadow-md" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="idTarea" value="{{$tarea->ID}}">
    <input type="hidden" id="accion" name="accion" value="">
    <input type="hidden" id="fechaPosterga" name="fechaPosterga" value="">
    <div class="flex flex-wrap w-full">
        <div class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Trabajos Estimados</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="text-xs items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                        <td class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tipo</td>
                        @foreach($valores["Estimado Inicial"] as $llave => $valor)
                            @if($llave != 'Número órden compañía')
                                <td class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">{{$llave}}</td>
                            @endif
                        @endforeach
                        </thead>
                        @foreach($valores as $llave => $valor)
                            <tr class="@if($llave == 'Total') font-bold @endif">
                                <td class="p-2 text-center content-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">{{$llave}}</td>
                                @foreach($valor as $key => $val)
                                    @if($key != 'Número órden compañía')
                                        <td class="p-2 text-center content-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">{{$val}}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


        <div class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Trabajos Realizados</h6>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center min-w-full divide-y divide-gray-200 text-xs table-responsive">
                        <thead class="align-bottom">
                        <tr class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trabajo</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Estado</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Trabajador</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Resolutor</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Fecha inicio</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Fecha fin</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tiempo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trabajos as $trabajo)
                            <tr>

                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{$trabajo->TipoTrabajo}}</p>
                                    @if(esAdicional($trabajo->ID)) <small>(Adicional)</small>@endif
                                    @if(esAdminDyp())
                                        <button type="button" class="eliminarTrabajo text-xs text-red-500" data-id="{{$trabajo->ID}}">
                                            <small><span class="fa fa-window-close" aria-hidden="true"></span></small>
                                        </button>
                                    @endif
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                        @if($trabajo->Estado == 'Comenzado')
                                            <span class="fa fa-hourglass-1 text-cyan-500"> {{$trabajo->Estado}}</span>
                                        @elseif($trabajo->Estado == 'Terminado')
                                            <span class="fa fa-check text-green-500"> {{$trabajo->Estado}}</span>
                                        @else
                                            <span class="fa fa-folder-open-o text-blue-500"> {{$trabajo->Estado}}</span>
                                        @endif
                                    </p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 leading-tight text-xs text-slate-400"> {{(isset($trabajo->Trabajador->Nombre)) ? ucfirst(strtolower(@$trabajo->Trabajador->Nombre)) : 'Sin info'}}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 leading-tight text-xs text-slate-400"> {{(isset($trabajo->Resolutor->Nombre)) ? ucfirst(strtolower(@$trabajo->Resolutor->Nombre)) : 'Sin info'}}</p>
                                </td>
                                <td class="p-2  bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">
                                            <span class="fa fa-arrow-circle-right text-cyan-500"> </span> {{$trabajo->FechaInicio}}
                                    </span>
                                </td>
                                <td class="p-2  bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">
                                           @if($trabajo->FechaTermino)<span class="fa fa-check text-green-500"> </span> {{$trabajo->FechaTermino}}@else - @endif
                                    </span>
                                </td>


                                <td class="p-2  bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-slate-400">
                                            <span class="fa @if($trabajo->Estado == 'Terminado') fa-hourglass-3 text-green-500 @else fa-hourglass-2 text-cyan-500 @endif"> </span>  {{textoMinutos(MinutosEntreFechas((($trabajo->FechaTermino != null)?$trabajo->FechaTermino :date('Y-m-d H:i:s')),$trabajo->created_at))}}
                                    </span>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <div class="w-full sm:w-100 md:w-2/3 lg:w-2/3 xl:w-2/3 p-10">
            <div class="flex flex-wrap">
                @if(esAdminDyp())
                        <div class="w-full p-2">
                            <label class="text-xs">Responsable</label>
                            <select name="input_responsable" id="input_responsable"  class="focus:shadow-primary-outline text-xs leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                <option value="">...</option>
                                @foreach($responsables as $responsable)
                                    <option value="{{$responsable->ID}}">{{$responsable->Email}} - {{$responsable->cargo->Cargo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2 p-2"><label class="text-xs">Hora inicio</label>
                            <input type="datetime-local" id="input_hora_inicio" name="input_hora_inicio"  class="focus:shadow-primary-outline text-xs leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                        </div>
                        <div class="w-1/2 p-2"> <label class="text-xs">Hora termino</label>
                            <input type="datetime-local" id="input_hora_termino" name="input_hora_termino"  class="focus:shadow-primary-outline text-xs leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                        </div>

                        <input type="hidden" id="tipotrabajo" name="tipotrabajo" value="">
                        <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3 p-2"><button data-boton="DESABOLLADOR" data-tipo="Trabajo" type="button" class="btnTrabajo  inline-block w-full p-2 font-bold text-center bg-gradient-to-tl from-blue-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="DESABOLLADOR"><span class="fa fa-hand-rock-o text-white font-bold"> &nbsp;&nbsp;</span><br> Desabolladura</button></div>
                        <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3 p-2"><button data-boton="PREPARADOR" data-tipo="Trabajo" type="button" class="btnTrabajo  inline-block w-full p-2 font-bold text-center bg-gradient-to-tl from-blue-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="PREPARADOR"><span class="fa fa-car text-white font-bold"> &nbsp;&nbsp;</span><br> Preparado</button></div>
                        <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3 p-2"><button data-boton="PINTOR" data-tipo="Trabajo" type="button" class="btnTrabajo  inline-block w-full p-2 font-bold text-center bg-gradient-to-tl from-blue-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="PINTOR"><span class="fa fa-paint-brush text-white font-bold"> &nbsp;&nbsp;</span><br> Pintura</button></div>
                        <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3 p-2"><button data-boton="PLASTIQUERO" data-tipo="Trabajo" type="button" class="btnTrabajo  inline-block w-full p-2 font-bold text-center bg-gradient-to-tl from-blue-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="PLASTIQUERO"><span class="fa fa-window-restore text-white font-bold"> &nbsp;&nbsp;</span><br> Plástico</button></div>
                        <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3 p-2"><button data-boton="PULIDOR" data-tipo="Trabajo" type="button" class="btnTrabajo  inline-block w-full p-2 font-bold text-center bg-gradient-to-tl from-blue-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="PULIDOR"><span class="fa fa-star text-white font-bold"> &nbsp;&nbsp;</span><br> Pulido</button></div>
                        <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3 p-2"><button data-boton="MECANICO" data-tipo="Trabajo" type="button" class="btnTrabajo  inline-block w-full p-2 font-bold text-center bg-gradient-to-tl from-blue-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="MECANICO"><span class="fa fa-wrench text-white font-bold"> &nbsp;&nbsp;</span><br> Mecánica</button></div>
                        <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3 p-2"><button data-boton="DESARMADOR/ARMADOR" data-tipo="Trabajo" type="button" class="btnTrabajo  inline-block w-full p-2 font-bold text-center bg-gradient-to-tl from-blue-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="DESARMADOR/ARMADOR"><span class="fa fa-wrench text-white font-bold"> &nbsp;&nbsp;</span><br> Armado / Desarmado</button></div>
                        <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3 p-2"><button data-boton="LAVADOR" data-tipo="Trabajo" type="button" class="btnTrabajo  inline-block w-full p-2 font-bold text-center bg-gradient-to-tl from-blue-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="LAVADOR"><span class="fa fa-wrench text-white font-bold"> &nbsp;&nbsp;</span><br> Lavado</button></div>
                        <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3 p-2"><button data-boton="REPARACION TERCERO" data-tipo="Trabajo" type="button" class="btnTrabajo  inline-block w-full p-2 font-bold text-center bg-gradient-to-tl from-blue-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="REPARACION TERCERO"><span class="fa fa-wrench text-white font-bold"> &nbsp;&nbsp;</span><br> Reparación Terceros</button></div>
                @endif
            </div>
        </div>

        <div class="w-full sm:w-100 md:w-1/3 lg:w-1/3 xl:w-1/3 p-10">
          <div class="flex flex-wrap">
              @if($tarea->Estado == 'Abierto')
                <div class="sm:w-full md:w-full lg:w-full xl:w-1/3 mb-4"><button data-boton="resolver" data-tipo="Resuelto" type="button" class="btnAccion mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-to-tl from-emerald-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="Resolver"><span class="fa fa-car text-white font-bold"> &nbsp;&nbsp;</span> Pasar a Control de Calidad</button></div>
              @endif
          </div>
        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(".btnAccion").on('click', function() {

        let tipo = $(this).data("tipo");
        let boton = $(this).val();

        if(tipo == 'Resuelto')
        {
            Swal.fire({
                title: 'Quiere '+boton+ ' la Tarea? ',
                text: 'Se guardarán los datos del formulario ingresados',
                showCancelButton: true,
                icon: 'success',
                confirmButtonText: 'Enviar',
                cancelButtonText: `Cancelar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    if(!document.formTarea.checkValidity())
                        document.formTarea.reportValidity()
                    else
                    {
                        $('#accion').val(tipo);
                        document.formTarea.submit()
                    }
                }
            });
        }
        if(tipo == 'Postergado')
        {
            Swal.fire({
                title: 'Quiere '+boton+ ' la Tarea? ',
                showCancelButton: true,
                icon: 'warning',
                confirmButtonText: 'Postergar',
                cancelButtonText: `Cancelar`,
                input: 'select',
                inputLabel: 'Motivo:',
                html:
                    '<p>Ingrese la fecha y motivo de la postergación</p><label>Fecha de postergación</label><input type="datetime-local" id="fechaPostergacion" class="swal2-input" value="{{fechaSLA('1440',date('Y-m-d H:i:s'))}}">',
                inputOptions: <?=json_encode($motivosPosterga)?>,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    if(!document.formTarea.checkValidity())
                        document.formTarea.reportValidity()
                    else
                    {
                        $('#accion').val(tipo);
                        $('#fechaPosterga').val($('#fechaPostergacion').val());
                        document.formTarea.submit()
                    }
                }
            });
        }


        if(tipo == 'Rechazado')
        {
            Swal.fire({
                title: 'Quiere '+boton+ ' la Tarea? ',
                text: 'Se guardarán los datos del formulario ingresados y debe escoger un motivo para '+boton,
                showCancelButton: true,
                icon: 'error',
                confirmButtonText: 'Rechazar',
                cancelButtonText: `Cancelar`,
                input: 'select',
                inputLabel: 'Motivo:',
                inputOptions: <?=json_encode($motivosRechazo)?>,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    if(!document.formTarea.checkValidity())
                        document.formTarea.reportValidity()
                    else
                    {
                        $('#accion').val(tipo);
                        document.formTarea.submit()
                    }
                }
            });
        }

    });



    $(".btnTrabajo").on('click', function() {

        let tipo = $(this).data("tipo");
        let boton = $(this).val();
        let inicio = $('#hora_inicio').val();
        let fin = $('#hora_fin').val();
        let responsable = $('#input_responsable').val();
        let hora_inicio = $('#input_hora_inicio').val();
        let hora_termino = $('#input_hora_termino').val();

        // validar si el responsable , hora_inicio y hora_fin tienen valores
        if(responsable == '' || hora_inicio == '' || hora_termino == '')
        {
            Swal.fire({
                title: 'Faltan datos por llenar',
                text: 'Se requiere que el responsable, hora inicio y hora termino tengan valores',
                showCancelButton: false,
                icon: 'warning',
                confirmButtonText: 'Enviar',
                cancelButtonText: `Cancelar`,
            });

            return false;
        }

            Swal.fire({
                title: 'Quiere Iniciar/Terminar el trabajo "'+boton+'" ?',
                text: 'Se guardará los datos del tipo de trabajo seleccionado',
                showCancelButton: true,
                icon: 'success',
                confirmButtonText: 'Enviar',
                cancelButtonText: `Cancelar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    if(!document.formTarea.checkValidity())
                        document.formTarea.reportValidity()
                    else
                    {
                        $('#tipotrabajo').val(boton);
                        $('#accion').val(tipo);
                        document.formTarea.submit();
                    }
                }
            });


    });

    $('.eliminarTrabajo').on('click', function (){
        let urlAtras = '{{route('flujodyp',[$tarea->DypID])}}';
        let idTrabajo = $(this).data("id");

        Swal.fire({
            icon: 'question',
            title: 'Quiere eliminar el trabajo?',
            text: 'Si elimina el trabajo , no se podrá recuperar la información de este posteriormente',
            showCancelButton: true,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                let data = {
                    'idTrabajo': idTrabajo
                };

                $.ajax({
                    url: '{{route('eliminartrabajo')}}',
                    type: 'POST',
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

</script>
