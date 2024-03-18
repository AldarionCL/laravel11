{{--
<form wire:submit.prevent="mount">
--}}

<div class="flex flex-wrap p-2 rounded-lg border border-1 border-blue-200 p-2  items-center mb-4 text-gray-900 border-blue-300  dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800">
    <h5 class="border-b border-blue-500">Datos Vehiculo</h5>
    <input type="hidden" name="idVehiculo"  id="idVehiculo" wire:model="idVehiculo">
    <div class="flex flex-wrap w-full">
        <div class="p-2 w-1/2">
            <label for="inputPatente">Patente</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                  <i class="fas fa-search" aria-hidden="true"></i>
                </span>
                <input type="text" name="inputPatente" wire:model="inputPatente" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Buscar Patente..."/>
                @error('inputPatente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>

        <div class="p-2 w-1/2">
            <button type="button" wire:click="search" class="mt-5 inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Buscar Vehiculo</button>
        </div>

        <div class="p-2 w-1/2">
            <label for="inputMarca">Marca</label>
                <x-simple-select
                    name="inputMarca"
                    id="inputMarca"
                    wire:model="inputMarca"
                    :options="$selectMarca"
                    value-field='ID'
                    text-field='Marca'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Marca"
                    :searchable="true"
                    class=" w-full"
                    no-options="No hay datos"
                />
                @error('inputMarca')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>

        <div class="p-2 w-1/2">
            <label for="inputModelo">Modelo</label>
                <x-simple-select
                    name="inputModelo"
                    id="inputModelo"
                    wire:model="inputModelo"
                    :options="$selectModelo"
                    value-field='ID'
                    text-field='Modelo'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Modelo"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                />
                @error('inputModelo')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>

      {{--  <div class="p-2 w-1/2">
            <label for="inputVersion">Versión</label>
                <x-simple-select
                    name="inputVersion"
                    id="inputVersion"
                    wire:model="inputVersion"
                    :options="$selectVersion"
                    value-field='ID'
                    text-field='Version'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Version"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                />

                @error('inputVersion')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>--}}

        <div class="p-2 w-1/2">
            <label for="inputColor">Color</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputColor" wire:model="inputColor" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder=""  required/>
                @error('inputColor')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>        </div>

        <div class="p-2 w-1/2">
            <label for="inputVin">VIN</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputVin" wire:model="inputVin" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="123456xxxx"  required/>
                @error('inputVin')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>


    </div>

</div>
{{--
</form>
--}}
