<form id="formCambiaEgreso" name="formCambiaEgreso"  method="get" action="{{route('cambiarFechaEgreso',[$idDyp])}}">
    <input type="hidden" name="idTarea" id="idTarea" value="">
    <ul class="w-100 text-xs font-mediartinez Sotoum text-gray-900 bg-white border border-gray-200 rounded-lg">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300"><span class="fa fa-user text-xs"> </span> Cambiar Fecha estimada de Egreso</li>
        <li class="w-full px-4 py-2 border-b border-gray-200" style="z-index: 99">
            Seleccione la nueva fecha estimada de egreso
        </li>
            <li class="w-full px-4 py-2 border-b border-gray-200 " style="z-index: 99">
                <input type="datetime-local" required name="InputFechaEgreso" value="{{$dyp->FechaEstimadaEntrega}}"
                       class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></input>
            </li>
        <li class="p-3">
            <button type="button" id="botonAccion" class="inline-block px-6 py-3 mr-3 font-bold text-center text-blue-500 uppercase align-middle transition-all bg-transparent border border-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Cambiar Fecha</button>
        </li>

    </ul>
</form>

<script>
    $('#botonAccion').on('click',function ()
    {
        let idTarea = $(this).data("id");
        let nombreTarea = $(this).data("tarea");

        Swal.fire({
            title: 'Quiere cambiar la fecha? ',
            text: 'Se guardará la nueva fecha estimada de egreso y se mantendrá el historial ',
            showCancelButton: true,
            icon: 'success',
            confirmButtonText: 'Cambiar',
            cancelButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                $('#idTarea').val(idTarea);
                document.formCambiaEgreso.submit();
            }
        });
    });
</script>
