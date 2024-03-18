<form name="formTarea" action="{{route('completartareadyp',[$tarea->ID])}}" method="post" id="formTarea" class=" p-2 border border-gray-200 rounded-lg m-0 shadow-md" enctype="multipart/form-data">

{{--
<form name="formTarea" wire:submit.prevent="completartareadyp" type="post" enctype="multipart/form-data">
--}}
    @csrf
    <div class="flex flex-wrap w-full">
        <div class="w-full sm:w-100 md:w-1/2 lg:w-2/3 xl:w-2/3">
            <input type="hidden" name="idTarea" value="{{$tarea->ID}}">
            <input type="hidden" name="idTipo" id="idTipo" value="{{$tarea->DypTipoID}}">
            <input type="hidden" id="accion" name="accion" value="">
            <input type="hidden" id="fechaPosterga" name="fechaPosterga" value="">
            <input type="hidden" id="MotivoPosterga" name="MotivoPosterga" value="">
            <input type="hidden" id="MotivoRechazo" name="MotivoRechazo" value="">
            @foreach($tarea->Tipo->Campos as $campo)
                <div class="border border-light mb-3 p-2 border-gray-300">
                    <label for="{{$campo->InputName}}" class="border-b-2 border-blue-300 block mb-2 text-sm font-medium text-gray-900">{{$campo->Campo}}</label>
                    @if($campo->Tipo == 'info')
                        <p id="{{$campo->InputName}}" name="{{$campo->InputName}}" class="{{$campo->Clase}}  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >{{$campo->VarOption}}</p>
                    @endif
                    @if($campo->Tipo == 'text')
                        <input type="text" id="{{$campo->InputName}}" name="{{$campo->InputName}}" class="{{$campo->Clase}} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{$campo->Placeholder}}" {{($campo->Requerido) ? 'required' : ''}}>
                    @endif
                    @if($campo->Tipo == 'number')
                        <input type="number" id="{{$campo->InputName}}" name="{{$campo->InputName}}" step="0.01" class="{{$campo->Clase}} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{$campo->Placeholder}}" {{($campo->Requerido) ? 'required' : ''}} value="0">
                    @endif
                    @if($campo->Tipo == 'checkbox')
                        <input id="{{$campo->InputName}}" name="{{$campo->InputName}}" type="checkbox" value="{{($campo->VarOption != null) ? $campo->VarOption : 1}}" name="bordered-checkbox"
                               class=" {{$campo->Clase}} w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{($campo->Requerido) ? 'required' : ''}}>
                    @endif
                    @if($campo->Tipo == 'date')
                        <input type="datetime-local" id="{{$campo->InputName}}" name="{{$campo->InputName}}" value="{{date('Y-m-d H:i')}}" class="{{$campo->Clase}} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{$campo->Placeholder}}" {{($campo->Requerido) ? 'required' : ''}}>
                    @endif
                    @if($campo->Tipo == 'textarea')
                        <textarea id="{{$campo->InputName}}" name="{{$campo->InputName}}" rows="4" class="{{$campo->Clase}} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{$campo->Placeholder}}" {{($campo->Requerido) ? 'required' : ''}}></textarea>
                    @endif
                    @if($campo->Tipo == 'file')
                        <input id="{{$campo->InputName}}" name="{{$campo->InputName}}"  type="file" class="{{$campo->Clase}} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{$campo->Placeholder}}" {{($campo->Requerido) ? 'required' : ''}} >
                    @endif
                    @if($campo->Tipo == 'files')
                        <input id="{{$campo->InputName}}" name="{{$campo->InputName}}[]"  type="file" class="{{$campo->Clase}} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{$campo->Placeholder}}" {{($campo->Requerido) ? 'required' : ''}} multiple>
                    @endif
                    @if($campo->Tipo == 'toggle')
                        <label class="m-3 relative inline-flex items-center cursor-pointer">
                            <input id="{{$campo->InputName}}" name="{{$campo->InputName}}" type="checkbox" value="{{($campo->VarOption != null) ? $campo->VarOption : 1}}"
                                   class="{{$campo->Clase}} sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium ">{{$campo->Placeholder}}</span>
                        </label>
                    @endif
                    @if($campo->Tipo == 'select')
                        <?php
                            $options = array();
                            foreach(explode(',',$campo->VarOption) as $opcion) {
                                $options[] = ['ID' => $opcion];
                            }?>
                        <x-simple-select
                            name="{{$campo->InputName}}"
                            id="{{$campo->InputName}}"
                            :options="$options"
                            value-field='ID'
                            text-field='ID'
                            placeholder="Seleccione ..."
                            search-input-placeholder="buscar"
                            :searchable="true"
                            class="{{$campo->Clase}} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            no-options="No hay datos"
                        />
                    @endif
                </div>
            @endforeach
            @if($tarea->DypTipoID == 23 || $tarea->DypTipoID == 3)
                <div class="border border-light mb-3 p-2 border-gray-300">
                    <livewire:dyp.componentes.modales.taller-grid : idSucursal="{{$dyp->SucursalID}}" idDyp="{{$tarea->DypID}}"/>
                </div>
            @endif


        </div>

        <div class="w-full sm:w-100 md:w-1/2 lg:w-1/3 xl:w-1/3 p-10">
            <div class="flex flex-wrap">
{{--
                <div class="sm:w-full md:w-full lg:w-full xl:w-1/3 mb-4"><button data-boton="resolver" data-tipo="Resuelto" type="submit" class="btnAccion mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-to-tl from-emerald-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="Resolver"><span class="fa fa-check text-white font-bold"> </span> prueba</button></div>
--}}
                <div class="sm:w-full md:w-full lg:w-full xl:w-1/3 mb-4"><button data-boton="resolver" data-tipo="Resuelto" type="button" class="btnAccion mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-to-tl from-emerald-500 to-teal-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="Resolver"><span class="fa fa-check text-white font-bold"> </span> Aceptar</button></div>
                @if($tarea->Tipo->PermitePostergar == 1)<div class="sm:w-full md:w-full lg:w-full xl:w-1/3 mb-4"><button data-boton="postergar" data-tipo="Postergado" type="button" class="btnAccion mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-to-tl from-orange-500 to-yellow-500 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="Postergar"><span class="fa fa-hourglass-2 text-white font-bold"> </span> Postergar</button></div>@endif
                @if($tarea->Tipo->PermiteRechazo == 1)<div class="sm:w-full md:w-full lg:w-full xl:w-1/3 mb-4"><button data-boton="rechazar" data-tipo="Rechazado" type="button" class="btnAccion mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-to-tl from-red-600 to-orange-600 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white" value="Rechazar"><span class="fa fa-close text-white font-bold"> </span> Rechazar</button></div>@endif
            </div>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>


    $( document ).ready(function() {
        if($('#idTipo').val() == 3)
        {
            Livewire.emit('openModal', 'dyp.componentes.modales.modal-edit-cliente', <?=json_encode(['idDyp'=>$tarea->DypID, 'idTarea'=>$tarea->ID])?>);
        }
    });


    @if($tarea->DypTipoID == 3)
    @endif

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
                inputValidator: (value) => {
                    $('#MotivoPosterga').val(value);
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    $('#accion').val(tipo);
                    $('#fechaPosterga').val($('#fechaPostergacion').val());
                    document.formTarea.submit()

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
                    inputValidator: (value) => {
                        $('#MotivoRechazo').val(value);
                    }
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                       $('#accion').val(tipo);
                       document.formTarea.submit()
                    }
                });
        }

    });

</script>
