<form action="{{route('guardarVehiculocpd',[$idCpd])}}" id="guardarVehiculo">
    <input type="hidden" name="idCPD" value="{{$idCpd}}">
    <ul class="w-100 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300"><span class="fa fa-car text-xs"> </span> Datos Vehículo </li>
        <li class="w-full px-4 py-2 border-b border-gray-200">
            Marca:
            <x-simple-select
                name="marcaInput"
                id="marcaInput"
                wire:model="inputMarca"
                :options="$marcas"
                value-field='Marca'
                text-field='Marca'
                placeholder="Seleccione ..."
                search-input-placeholder="Buscar Marca"
                :searchable="true"
                class=" form-select-sm"
                no-options="No hay datos"
            />
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200">
            Modelo:
            <x-simple-select
                name="modeloInput"
                id="modeloInput"
                wire:model="inputModelo"
                :options="$modelos"
                value-field='Modelo'
                text-field='Modelo'
                placeholder="Seleccione ..."
                search-input-placeholder="Buscar Modelo"
                :searchable="true"
                class=" form-select-sm"
                no-options="No hay datos"
            />
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200">
            Version:
            <input type="text" name="versionInput" value="{{$cpd->Version}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200">
            Color:
            <input type="text" name="colorInput" value="{{$cpd->Color}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200">
            Año:
            <input type="text" name="anioInput" value="{{$cpd->Anio}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200">
            Patente:
            <input type="text" name="patenteInput" value="{{$cpd->Patente}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </li>
        <li class="w-full px-4 py-2 rounded-b-lg">
            Vin:
            <input type="text" name="vinInput" value="{{$cpd->Vin}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </li>
        <li class="w-full px-4 py-2 rounded-b-lg">
            Cajón:
            <input type="text" name="cajonInput" value="{{$cpd->Cajon}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </li>
    </ul>
    <div class="float-left p-3"><button type="submit" class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Guardar datos</button></div>
    <div class="float-right p-3"><button type="button" wire:click="$emit('closeModal')" class="inline-block px-6 py-3 mr-3 font-bold text-center text-black uppercase align-middle transition-all bg-orange-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Cancelar</button></div>
</form>
