<form id="formCreaTarea" name="formCreaTarea"  method="get" action="{{route('creaTareaTDRIVE',[$idTdrive])}}"
class="p-3">
    <input type="hidden" name="idTarea" id="idTarea" value="">
    <ul class="w-100 text-xs font-mediartinez Sotoum text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600 bg-gray-300"><span class="fa fa-user text-xs"> </span> Archivos subidos</li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600" style="z-index: 99">
            Lista de archivos adjuntados en las diversas tareas.
        </li>
        @foreach($tareas as $tarea)
            @if(count($tarea->Archivos)>0)
                <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600" style="z-index: 99">
                    <div class="flex">
                        <div class="w-1/2">
                            <strong>{{$tarea->Tipo->NombreTarea}}</strong>
                        </div>
                        <div class="w-1/2 pl-2">
                            @foreach($tarea->Archivos as $archivo)
                                <strong>{{$archivo->inputName}}:</strong> <br><span class="fa fa-paperclip"> </span> <a href="{{'/storage/'.$archivo->path}}" target="_blank"> {{$archivo->name}}</a><br>
                            @endforeach
                        </div>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>

</form>

    <div class="flex flex-wrap w-full p-4">
        <form name="formArchivos" action="{{route('guardarArchivos')}}" method="post" id="formArchivos" class="w-full p-2 border border-gray-200 rounded-lg dark:border-gray-700 m-0 shadow-md" enctype="multipart/form-data">
        <input type="hidden" name="idTdrive" id="idTdrive" value="{{$idTdrive}}">
            @csrf
            <h4>Subir archivos</h4>
        <div class="p-2 w-full">
            <label for="inputTarea">Tarea del flujo</label>
            <x-simple-select
                name="inputTarea"
                id="inputTarea"
                wire:model="inputTarea"
                :options="$arrayTareas"
                value-field='ID'
                text-field='NombreTarea'
                placeholder="Seleccione ..."
                search-input-placeholder="Tarea"
                :searchable="true"
                class=" w-full"
                no-options="No hay datos"
                required
            />
            @error('inputTarea')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>
        <div class="p-2 w-full">
            <label for="input_Archivos">Archivos</label>
            <input required id="input_Archivos" name="input_Archivos[]"  type="file" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""  multiple>
            @error('input_Archivos')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>
        <div class="p-2 w-full">
            <br>
            <button type="submit" id="botonArchivos" class="inline-block px-6 py-3 mr-3 font-bold text-center text-blue-500 uppercase align-middle transition-all bg-transparent border border-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Cargar</button>
        </div>
        </form>
    </div>

<script>
    $('.nuevaTarea').on('click',function ()
    {
        let idTarea = $(this).data("id");
        let nombreTarea = $(this).data("tarea");

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
    });
</script>
