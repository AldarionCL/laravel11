<form class="card" wire:submit.prevent="search">

<div class="card-body" style="min-height: 400px;">
        <div class="flex flex-row align-items-end">
            <div class="form-group xs:w-1/2 sm:w-1/2 lg:w-1/4 p-2">

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

            <div class="form-group xs:w-1/2 sm:w-1/2 lg:w-1/4 p-2">
                <label for="searchSucursal">Sucursales</label>
                <x-simple-select
                    name="searchSucursal"
                    id="searchSucursal"
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

            <div class="form-group xs:w-1/2 sm:w-1/2 lg:w-1/4 p-2">
                <label for="inputFechaInicio">Fecha inicio</label>
                <input class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                       wire:model="inputFechaInicio" type="date" />

            </div>
            <div class="form-group xs:w-1/2 sm:w-1/2 lg:w-1/4 p-2">
                <label for="searchinputFechaFinSucursal">Fecha Fin</label>
                <input class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                       wire:model="inputFechaFin" type="date" />

            </div>
            @if($tipo == 'agendamiento')
                <div class="form-group xs:w-1/2 sm:w-1/2 lg:w-1/4 p-2">
                    <label for="searchSucursal">Tipo de Agenda</label>
                    <x-simple-select
                        name="searchTipoAgenda"
                        id="searchTipoAgenda"
                        wire:model="searchTipoAgenda"
                        :options="$tipoagenda"
                        value-field='ID'
                        text-field='Tipo'
                        placeholder="Todos"
                        search-input-placeholder="Buscar Tipo"
                        :searchable="true"
                        class=" form-select-sm"
                        no-options="No hay datos"
                        multiple="true"
                    />
                </div>
            @endif

            <hr >

            <div class="input-group xs:w-1/2 sm:w-1/2 lg:w-1/4 p-2" style="margin-top: 24px">
                @if($tipo == 'agendamiento')
                <a  href="{{route('agendamiento_diario')}}" type="button" id="btnLimpiar" class="m-0.5 btn btn-default btn-sm">Limpiar filtros</a>
                @endif
                    &nbsp;&nbsp;<button  type="submit" id="btnBuscar" class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md ">Filtrar</button>
            </div>
        </div>
    <br>
    <br>
    @if($tipo == 'lista_asistencia')
        <div class="block overflow-x-auto">
            @livewire('reception.datatables.reporte-visitas-datatable',
            ['searchGerencia' => $searchGerencia,
            'searchSucursal' => $searchSucursal,
            'inputFechaInicio' => $inputFechaInicio,
            'inputFechaFin' => $inputFechaFin])
        </div>
    @endif

    @if($tipo == 'agendamiento')
        <div class="block overflow-x-auto">
            @livewire('reception.componentes.lista-agendamientos',
            ['searchGerencia' => $searchGerencia,
            'searchSucursal' => $searchSucursal,
            'inputFechaInicio' => $inputFechaInicio,
            'inputFechaFin' => $inputFechaFin])
        </div>
    @endif

</div>

<br>

</form>

