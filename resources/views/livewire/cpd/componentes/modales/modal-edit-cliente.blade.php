<form action="{{route('guardarCliente',[@$cliente->ID])}}" id="guardarCliente">
    <input type="hidden" name="idCPD" value="{{$idCpd}}">
    <ul class="w-100 text-xs font-mediartinez Sotoum text-gray-900 bg-white border border-gray-200 rounded-lg">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300"><span class="fa fa-user text-xs"> </span> Datos Cliente </li>
        <li class="w-full px-4 py-2 border-b border-gray-200">Nombre: <input type="text" name="nombreInput" value="{{$cpd->ClienteNombre}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></li>
        <li class="w-full px-4 py-2 border-b border-gray-200">Apellido: <input type="text" name="apellidoInput" value="{{$cpd->ClienteApellido}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></li>
        <li class="w-full px-4 py-2 border-b border-gray-200">Rut: <input type="text" name="rutInput" value="{{$cpd->ClienteRut}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></li>
        <li class="w-full px-4 py-2 border-b border-gray-200">Teléfono: <input type="text" name="telefonoInput" value="{{$cpd->ClienteTelefono}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></li>
        <li class="w-full px-4 py-2 border-b border-gray-200">E-mail: <input type="text" name="emailInput" value="{{$cpd->ClienteEmail}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></li>
        <li class="w-full px-4 py-2 border-b border-gray-200">Dirección: <input type="text" name="direccionInput" value="{{$cpd->ClienteDireccion}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></li>
        <li class="w-full px-4 py-2 rounded-b-lg">Sucursal:
            <x-simple-select
                name="inputSucursal"
                id="inputSucursal"
                wire:model="inputSucursal"
                :options="$selectSucursal"
                value-field='ID'
                text-field='Sucursal'
                placeholder="Seleccione Tipo de cliente..."
                search-input-placeholder="Tipo de cliente"
                :searchable="true"
                class=" form-select-sm"
                no-options="No hay datos"
                wire:emit="update"
            />
        </li>

    </ul>

    <div class="float-left p-3"><button type="submit" class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Guardar datos</button></div>
    <div class="float-right p-3"><button type="button" wire:click="$emit('closeModal')" class="inline-block px-6 py-3 mr-3 font-bold text-center text-black uppercase align-middle transition-all bg-orange-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Cancelar</button></div>
</form>
