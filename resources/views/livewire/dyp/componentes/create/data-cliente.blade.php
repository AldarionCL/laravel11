<div class="flex flex-wrap p-2 rounded-lg border border-1 border-blue-200 p-2  items-center mb-4 text-gray-900 border-blue-300 ">
    <h5 class="border-b border-blue-500">Datos cliente</h5>
    <input type="hidden" name="idCliente"  id="idCliente" wire:model="idCliente">
    <div class="flex flex-wrap w-full">
        <div class="p-2 w-1/2">
            <label for="inputRutCliente">Rut cliente</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                  <i class="fas fa-search" aria-hidden="true"></i>
                </span>
                <input type="text" name="inputRutCliente" wire:model="inputRutCliente" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Buscar rut..."/>
                @error('inputRutCliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>

        <div class="p-2 w-1/2">
            <button type="button" wire:click="search" class="mt-5 inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Buscar Cliente</button>
        </div>

        <div class="p-2 w-1/2">
            <label for="inputNombreCliente">Nombre cliente</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputNombreCliente" wire:model="inputNombreCliente" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Nombre cliente" required/>
                @error('inputNombreCliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>

        <div class="p-2 w-1/2">
            <label for="inputApellidoCliente">Apellido cliente</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputApellidoCliente" wire:model="inputApellidoCliente" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Apellido cliente" required/>
                @error('inputApellidoCliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>

        <div class="p-2 w-1/2">
            <label for="inputEmailCliente">Email cliente</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputEmailCliente" wire:model="inputEmailCliente" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="email1@gmail.com" required/>
                @error('inputEmailCliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>

        <div class="p-2 w-1/2">
            <label for="inputTelefonoCliente">Teléfono cliente</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputTelefonoCliente" wire:model="inputTelefonoCliente" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="569123456789" required/>
                @error('inputTelefonoCliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>

        <div class="p-2 w-1/2">
            <label for="inputTelefono2Cliente">Teléfono 2 cliente</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputTelefono2Cliente" wire:model="inputTelefono2Cliente" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="569123456789"/>
                @error('inputTelefono2Cliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>

        <div class="p-2 w-1/2">
            <label for="inputTelefono3Cliente">Teléfono 3 cliente</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <input type="text" name="inputTelefono3Cliente" wire:model="inputTelefono3Cliente" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="569123456789"/>
                @error('inputTelefono3Cliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>
    </div>
</div>
