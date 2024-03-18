<form id="formCreaTarea" name="formCreaTarea"  method="get" action="{{route('creaTareaDYP',[$idDyp])}}">
    <input type="hidden" name="idTarea" id="idTarea" value="">
    <input type="hidden" name="motivoTarea" id="motivoTarea" value="">
    <ul class="w-100 text-xs font-mediartinez Sotoum text-gray-900 bg-white border border-gray-200 rounded-lg">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300"><span class="fa fa-user text-xs"> </span> Crear Nueva tarea </li>
        <li class="w-full px-4 py-2 border-b border-gray-200" style="z-index: 99">
            Seleccione la nueva tarea a crear:
        </li>
        @foreach($tareas as $tarea)
            <li class="w-full px-4 py-2 border-b border-gray-200 @if($tieneAsignacion && $tarea->ID == 1) text-gray-500 @endif" style="z-index: 99">
                <div class="flex">
                    <div class="w-2/3">
                        <strong>{{$tarea->NombreTarea}}</strong> <br><small>{{$tarea->Descripcion}}</small>
                    </div>
                    <div class="w-1/3">
                        @if($tieneAsignacion && $tarea->ID == 1)
                            <button type="button"  disabled
                                    class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-gray-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Crear</button>                        @else
                        <button type="button" name ="nuevaTarea" value="{{$tarea->ID}}" data-id="{{$tarea->ID}}" data-tarea="{{$tarea->NombreTarea}}"
                                class="nuevaTarea inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Crear</button>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</form>

<script>
    $('.nuevaTarea').on('click',function ()
    {
        let idTarea = $(this).data("id");
        let nombreTarea = $(this).data("tarea");

        if(idTarea == 23)
        {
            Swal.fire({
                title: 'Quiere crear la Tarea? ',
                text: 'Se creará la tarea '+nombreTarea,
                input: "select",
                inputOptions: {
                    "Repuesto VOR": "Repuesto VOR",
                    "Repuesto Adicional": "Repuesto Adicional",
                    "M.O. Adicional": "M.O. Adicional",
                    "Mala Evaluación": "Mala Evaluación",
                    "Repuesto Mal Pedido": "Repuesto Mal Pedido",
                    "AD no pagado CIA": "AD no pagado CIA",
                    "Proveedor Externo": "Proveedor Externo",
                },
                inputPlaceholder: "Seleccione el motivo...",
                showCancelButton: true,
                icon: 'success',
                confirmButtonText: 'Crear',
                cancelButtonText: `Cancelar`,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value != "") {
                            $('#motivoTarea').val(value);
                            resolve();
                        } else {
                            resolve("Tiene que seleccionar un motivo");
                        }
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#idTarea').val(idTarea);
                    document.formCreaTarea.submit();
                }
            });
        }
        else{
            Swal.fire({
                title: 'Quiere crear la Tarea? ',
                text: 'Se creará la tarea '+nombreTarea,
                showCancelButton: true,
                icon: 'success',
                confirmButtonText: 'Crear',
                cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#idTarea').val(idTarea);
                    document.formCreaTarea.submit();
                }
            });
        }
    });
</script>
