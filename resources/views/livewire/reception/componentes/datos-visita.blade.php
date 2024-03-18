<form wire:submit.prevent="search">
    <div class="relative p-4 min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl text-gray-700 dark:text-white dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <h5 class="text-gray-500 dark:text-white">
            <span class="fa fa-search"></span> Búsqueda de visita
        </h5>
        <div class="card-body">
            <div class="flex flex-wrap align-items-end">
                <div class="input-group w-1/2" id="cajaRut">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Rut</span>
                    </div>
                    <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                        <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                          <i class="fas fa-search" aria-hidden="true"></i>
                        </span>
                        <input type="text" id="inputRut" wire:model="inputRut" placeholder="11.111.111-1" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" />
                    </div>
                    <input type="hidden" class="form-control" id="inputID" wire:model="inputID" >
                </div>
                <div class="input-group w-1/2 p-2" style="margin-top: 15px">
                    <button id="btnBuscar" wire:click="search()" class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Buscar</button>
                </div>
                @if($msj != '')
                    <div class="col col-md-12 col-lg-12 col sm-12 {{$colorfind}}">
                        <i class=" fa fa-id-badge text-size-lg" aria-hidden="true"></i> {{$msj}}
                    </div>
                @endif
                @if($msjAgenda != '')
                    <div class="col col-md-12 col-lg-12 col sm-12 text-info">
                        <i class="text-info fa fa-address-book-o text-size-lg" aria-hidden="true"></i> {{$msjAgenda}}
                    </div>
                @endif

                <div class="">
                    @error('inputRut')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                </div>

            </div>
        </div>
    </div>

<div id="formdatos" class=" relative p-4 min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl text-gray-700 dark:text-white dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border" @if($msj == '' && $msjAgenda == '') {{--style="display: none"--}} @endif>
    <div class="h5 mb-3">
        <span class="fa fa-user"></span>   Datos del cliente
    </div>
    <div class="card-body">
        <div class="flex flex-wrap align-items-end">
            <div class="form-group sm:w-full md:w-1/2 lg:w-1/2 p-2">
                <label for="inputNombre">Nombre</label>
                <input type="text"  id="inputNombres" wire:model="inputNombres" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                @error('inputNombres')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
            <div class="form-group sm:w-full md:w-1/2 lg:w-1/2 p-2">
                <label for="inputApellidos">Apellido</label>
                <input type="text" id="inputApellidos" wire:model="inputApellidos" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                @error('inputApellidos')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>

            <div class="form-group sm:w-full md:w-full lg:w-1/3 p-2">
                <label for="inputComuna">Comuna</label>
                <x-simple-select
                    name="inputComuna"
                    id="inputComuna"
                    wire:model="inputComuna"
                    :options="$communes"
                    value-field='ID'
                    text-field='Comuna'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Buscar Comuna"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                />
                @error('inputComuna')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>

            <div class="form-group sm:w-full md:w-full lg:w-1/3 p-2">
                <label for="inputComuna">Tipo ingreso</label>
                <x-simple-select
                    name="inputTipoCliente"
                    id="inputTipoCliente"
                    wire:model="inputTipoCliente"
                    :options="$tipoClientes"
                    value-field='tipo'
                    text-field='tipo'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Tipo cliente"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                />
                @error('inputTipoCliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>

            <div class="form-group sm:w-full md:w-full lg:w-1/3 p-2">
                <label for="inputSucursal">Sucursal</label>
                <x-simple-select
                    name="inputSucursal"
                    id="inputSucursal"
                    wire:model="inputSucursal"
                    :options="$sucursalesUsuario"
                    value-field='SucursalID'
                    text-field='Sucursal'
                    placeholder="Seleccione ..."
                    search-input-placeholder="Sucursal"
                    :searchable="true"
                    class=" form-select-sm"
                    no-options="No hay datos"
                />
                @error('inputSucursal')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>

        </div>
    </div>


    <div class="h5 mb-3 mt-6">
        <span class="fa fa-car"></span>   Datos del vehículo
    </div>
    <div class="card-body flex flex-wrap align-items-end">
        <div class="form-group sm:w-full md:w-1/2 lg:w-1/3 p-2">
            <label for="inputPatente">Patente</label>
            <input style="text-transform: uppercase;" type="text" id="inputPatente" wire:model="inputPatente" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
            @error('inputPatente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>
        <div class="form-group sm:w-full md:w-1/2 lg:w-1/3 p-2">
            <label for="inputCantidad">Cantidad personas</label>
            <input type="number" id="inputCantidad" wire:model="inputCantidad" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
            @error('inputCantidad')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
        </div>
    </div>
    <div class="form-group sm:w-full md:w-1/2 lg:w-1/3 p-2 align-self-end">
        <button wire:click="guardar" class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-emerald-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
            Registrar Visita
        </button>
    </div>
</div>
</form>

<livewire:reception.componentes.lista-visita />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $("#inputRut")
        .rut({formatOn: 'keyup', validateOn: 'keyup'});

</script>

<script>

    function marcarRetiro(caso)
    {
        //let caso = $(this).data("id");

        Swal.fire({
            title: 'Cliente se retira de la sucursal?',
            text: 'Indique si el cliente se retira con factura',
            showDenyButton: true,
            showCancelButton: false,
            icon: 'warning',
            confirmButtonText: 'Retiro',
            denyButtonText: `Retiro con Factura`,
            cancelButtonText: `Cancelar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.replace('{{route('marcar_salida')}}'+"/"+caso);
            } else if (result.isDenied) {

                Swal.fire({
                    title: 'Retirar con factura',
                    text: 'Ingrese el número de la patente (sin puntos ni guión)',
                    input: 'text',
                    imageUrl: '{{ asset('assets/img/patente.jpg') }}',
                    imageHeight: 100,
                    //icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Retirar',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Debe ingresar el número de la patente'
                        }
                        else
                        {
                            window.location.replace('{{route('marcar_salida')}}'+"/"+caso+'?patente='+value);
                        }
                    }
                });
            }
        });
    }

</script>

