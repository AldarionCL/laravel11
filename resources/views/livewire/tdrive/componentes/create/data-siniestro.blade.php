<div class="flex flex-wrap p-2 rounded-lg border border-1 border-blue-200 p-2  items-center mb-4 text-gray-900 border-blue-300  dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800">
    <h5 class="border-b border-blue-500">Datos Siniestro</h5>
    <div class="flex flex-wrap w-full">

        <div class="p-2 w-1/2">
            <label for="inputColor">Sucursal de servicio</label>
            <x-simple-select
                name="inputSucursal"
                id="inputSucursal"
                wire:model="inputSucursal"
                :options="$selectSucursalServicio"
                value-field='ID'
                text-field='Sucursal'
                placeholder="Seleccione la sucursal de servicio..."
                search-input-placeholder="Sucursal"
                :searchable="true"
                class=" form-select-sm"
                no-options="No hay datos"
            />
            @error('inputSucursal')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>


        <div class="p-2 w-1/2">
            <label for="inputColor">Tipo de cliente</label>
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
            @error('inputTipoCliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>

        <div class="p-2 w-1/2">
            <label for="inputColor">Compañía de seguro</label>
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
            @error('inputCiaSeguro')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>

      {{--  <div class="p-2 w-1/2">
            <label for="inputNumPoliza">Número de poliza</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputNumPoliza" wire:model="inputNumPoliza" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="1234xxxx" />
                @error('inputNumPoliza')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>--}}

        <div class="p-2 w-1/2">
            <label for="inputFechaEmision">Fecha de emisión</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="datetime-local" name="inputFechaEmision" wire:model="inputFechaEmision" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"  />
                @error('inputFechaEmision')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>

        <div class="p-2 w-1/2">
            <label for="inputNumeroSiniestro">Número Siniestro</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputNumeroSiniestro" wire:model="inputNumeroSiniestro" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="1234556xxxx"
                @if($siniestroRequerido===true) required="required" @endif/>
                @error('inputNumeroSiniestro')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>
{{--
        <div class="p-2 w-1/2">
            <label for="inputNumeroOT">Número OT</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputNumeroOT" wire:model="inputNumeroOT" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="1234556xxxx" />
                @error('inputNumeroOT')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>--}}


    </div>
</div>

