<form action="{{route('guardarSiniestro',[$idDyp])}}" id="guardarCSiniestro">
    <input type="hidden" name="idDYP" value="{{$idDyp}}">
    <ul class="w-100 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300">
            <span class="fa fa-wrench text-xs"> </span> Datos Siniestro
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Magnitud Daño: </strong>
            <x-simple-select
                name="inputMagnitud"
                id="inputMagnitud"
                wire:model="inputMagnitud"
                :options="$selectMagnitud"
                value-field='Magnitud'
                text-field='Magnitud'
                placeholder="Seleccione la magnitud del daño..."
                search-input-placeholder="Magnitud del daño"
                :searchable="true"
                class=" form-select-sm"
                no-options="No hay datos"
            />
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Tipo Cliente: </strong>
            <x-simple-select
                name="inputTipoCliente"
                id="inputTipoCliente"
                wire:model="inputTipoCliente"
                :options="$selectTipoCliente"
                value-field='TipoCliente'
                text-field='TipoCliente'
                placeholder="Seleccione Tipo de cliente..."
                search-input-placeholder="Tipo de cliente"
                :searchable="true"
                class=" form-select-sm"
                no-options="No hay datos"
                wire:emit="update"
            />
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Compañía Seguro: </strong>
            <x-simple-select
                name="inputCiaSeguro"
                id="inputCiaSeguro"
                wire:model="inputCiaSeguro"
                :options="$selectCiaSeguro"
                value-field='CiaSeguro'
                text-field='CiaSeguro'
                placeholder="Seleccione compañía de seguro..."
                search-input-placeholder="Compañía Seguro"
                :searchable="true"
                class=" form-select-sm"
                no-options="No hay datos"
            />
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200">Número OT: <input type="text" name="Ot_principal" wire:model="inputOT" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></li>
        <li class="w-full px-4 py-2 rounded-b-lg">Número Siniestro: <input type="text" name="NumeroSiniestro" wire:model="inputSiniestro" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></li>
    </ul>
    <div class="float-left p-3"><button type="submit" class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Guardar datos</button></div>
    <div class="float-right p-3"><button type="button" wire:click="$emit('closeModal')" class="inline-block px-6 py-3 mr-3 font-bold text-center text-black uppercase align-middle transition-all bg-orange-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Cancelar</button></div>
</form>
