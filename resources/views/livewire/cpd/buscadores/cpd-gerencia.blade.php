<form class="" wire:submit.prevent="search">

        <div class="flex flex-row">

            <div class="m-2 p-2 xs:w-1/2 sm:w-1/2 lg:w-1/2 xl:w-2/3">
                <label for="searchSucursal">Marca</label>
                <x-simple-select
                    name="searchMarca"
                    id="searchMarca"
                    wire:model="searchMarca"
                    :options="$marcas"
                    value-field='Marca'
                    text-field='Marca'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Marca"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                />
            </div>

            <div class="m-2 p-2 xs:w-1/2 sm:w-1/2 lg:w-1/2 xl:w-2/3">
                <label for="searchSucursal">Modelo</label>
                <x-simple-select
                    name="searchModelo"
                    id="searchModelo"
                    wire:model="searchModelo"
                    :options="$modelos"
                    value-field='Modelo'
                    text-field='Modelo'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Modelo"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                />
            </div>


            <div class="m-2 p-2 xs:w-1/2 sm:w-1/2 lg:w-1/2 xl:w-1/2">
                <label for="inputFechaInicio">Fecha inicio</label>
                <input class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md " wire:model="inputFechaInicio" type="date" />

            </div>
            <div class="m-2 p-2 xs:w-1/2 sm:w-1/2 lg:w-1/2 xl:w-1/2">
                <label for="searchinputFechaFinSucursal">Fecha Fin</label>
                <input class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md" wire:model="inputFechaFin" type="date" />
            </div>

            <div class="m-2 p-2 xs:w-1/2 sm:w-1/2 lg:w-1/2 xl:w-1/4">
                &nbsp;&nbsp;<button  type="submit" id="btnBuscar"
                         class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-blue-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                    Filtrar
                </button>
            </div>

        </div>
</form>

<hr>

