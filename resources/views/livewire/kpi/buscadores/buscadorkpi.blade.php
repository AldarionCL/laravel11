<form class="card" wire:submit.prevent="search">
    <div class="card-body">
        <div class="flex-grow flex flex-row align-items-end">

            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchGerencia">Gerencias</label>
                <x-simple-select
                    name="searchGerencia"
                    id="searchGerencia"
                    wire:change="search"
                    wire:model="searchGerencia"
                    :options="$gerencias"
                    value-field='ID'
                    text-field='Gerencia'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Gerencia"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>

            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchGerencia">Sucursales</label>
                <x-simple-select
                    name="searchSucursal"
                    id="searchSucursal"
                    wire:change="search"
                    wire:model="searchSucursal"
                    :options="$sucursales"
                    value-field='ID'
                    text-field='Sucursal'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Sucursal"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>

            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchVendedores">Vendedores</label>
                <x-simple-select
                    name="searchVendedores"
                    id="searchVendedores"
                    wire:change="search"
                    wire:model="searchVendedores"
                    :options="$vendedores"
                    value-field='ID'
                    text-field='Nombre'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Vendedor"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>


            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchMarca">Marcas</label>
                <x-simple-select
                    name="searchMarca"
                    id="searchMarca"
                    wire:change="search"
                    wire:model="searchMarca"
                    :options="$marcas"
                    value-field='ID'
                    text-field='Marca'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Marca"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>

            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchTipoVenta">Tipo Venta</label>
                <x-simple-select
                    name="searchTipoVenta"
                    id="searchTipoVenta"
                    wire:change="search"
                    wire:model="searchTipoVenta"
                    :options="$tipoventas"
                    value-field='ID'
                    text-field='TipoVenta'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Tipo Venta"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>

            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchModelo">Modelos</label>
                <x-simple-select
                    name="searchModelo"
                    id="searchModelo"
                    wire:change="search"
                    wire:model="searchModelo"
                    :options="$modelos"
                    value-field='ID'
                    text-field='Modelo'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Modelos"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>
        </div>


        <div class="flex-grow flex flex-row align-items-end">

            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchCanal">Canal</label>
                <x-simple-select
                    name="searchCanal"
                    id="searchCanal"
                    wire:change="search"
                    wire:model="searchCanal"
                    :options="$canales"
                    value-field='ID'
                    text-field='Canal'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Canal"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>

            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchCierre">Cierre</label>
                <x-simple-select
                    name="searchCierre"
                    id="searchCierre"
                    wire:change="search"
                    wire:model="searchCierre"
                    :options="$cierres"
                    value-field='ID'
                    text-field='Cierre'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Cierre"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>

            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchCupon">Cupon</label>
                <x-simple-select
                    name="searchCupon"
                    id="searchCupon"
                    wire:change="search"
                    wire:model="searchCupon"
                    :options="$cupones"
                    value-field='ID'
                    text-field='Cupon'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Cupon"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>

            <div class="p-2 form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="searchOficina">Con oficina</label>
                <x-simple-select
                    name="searchOficina"
                    id="searchOficina"
                    wire:change="search"
                    wire:model="searchOficina"
                    :options="$oficinas"
                    value-field='ID'
                    text-field='Oficina'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Oficina"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                    multiple="true"
                />
            </div>

        </div>
        <div class="p-4 flex-grow flex flex-row align-items-end">

            <div class="form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="inputFechaInicio">Fecha inicio</label>
                <input class="form-control" wire:model="inputFechaInicio" type="date" />
            </div>

            <div class="form-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                <label for="inputFechaFin">Fecha Fin</label>
                <input class="form-control" wire:model="inputFechaFin" type="date" />
            </div>


            <div class="input-group xs:w-1/2 sm:w-1/2 lg:w-1/4">
                &nbsp;&nbsp;<button  type="submit" id="btnBuscar" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Filtrar</button>
            </div>
        </div>
        <br>
        <br>
        @if($tipo == 'lista_asistencia')
            @livewire('reception.datatables.reporte-visitas-datatable',
            ['searchGerencia' => $searchGerencia,
            'searchSucursal' => $searchSucursal,
            'inputFechaInicio' => $inputFechaInicio,
            'inputFechaFin' => $inputFechaFin])
        @endif

        @if($tipo == 'agendamiento')
            @livewire('reception.componentes.lista-agendamientos',
            ['searchGerencia' => $searchGerencia,
            'searchSucursal' => $searchSucursal,
            'inputFechaInicio' => $inputFechaInicio,
            'inputFechaFin' => $inputFechaFin])
        @endif

    </div>

    <br>

</form>

