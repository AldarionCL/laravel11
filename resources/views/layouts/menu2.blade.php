<!-- sidenav  -->
<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
           sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-size-sm whitespace-nowrap dark:text-white text-slate-700"
           href="
           @if( session('call') === 3 )/accesorios
           @elseif( session('call') === 4 )/operaciones
           @elseif( session('call') === 5 )/landbot
           @elseif( session('call') === 6 )/recepcion
           @elseif( session('call') === 7 )/dyp
           @else /call-center
           @endif
         ">
            <img src="{{ asset('assets/img/logo-roma-dark.svg') }}"
                 class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-14"
                 alt="main_logo"/>
            <img src="{{ asset('assets/img/logo-roma-white.svg') }}"
                 class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-14"
                 alt="main_logo"/>
            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand"></span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"/>

    <div class="items-center block w-auto max-h-screen grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">

            @if( session('call') === 7 )
                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ url('/dyp/nuevodyp') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('dyp/nuevodyp*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-address-book-o text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Crear Paint & Body Board</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ url('/dyp') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('dyp') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-tasks text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Lista Paint & Body Board</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ url('/dyp/mistareas') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('dyp/mistareas*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-folder-open-o  text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mis tareas</span>
                    </a>
                    <ul class=" ml-4 flex flex-col pl-0 mb-0">
                        <li class=" w-full">
                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ url('/dyps/leerQr') }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('dyps/leerQr*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-qrcode text-size-sm"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Iniciar/Terminar Trabajo</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ url('/dyp/vehiculostaller/285') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('dyp/vehiculostaller*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-building-o  text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Vehículos en patio</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <div class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('dyp/reporte*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-ticket text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Reportes</span>
                    </div>
                    <ul class=" ml-4 flex flex-col pl-0 mb-0">
                        <li class=" w-full">
                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ url('/dyp/reporte/etapas') }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('dyp/reporte/etapas*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-clock-o text-size-sm"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Tiempos por etapa</span>
                            </a>
                        </li>
                    </ul>
                </li>


            @endif

            @if( session('call') === 0 || session('call') === 2 )
                <li class="mt-0.5 w-full">
                    <a class="dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ url('/ticket') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('ticket*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-ticket text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ticket</span>
                    </a>
                </li>
            @endif

            @if( session('call') === 1 )
                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ url('/call-center') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('call*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-volume-control-phone text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Call Center</span>
                    </a>
                </li>
            @endif

            @if( session('call') === 3 )
                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ url('/accesorios') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('accessory*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-car text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Accesorios</span>
                    </a>
                </li>
            @endif

            @if( session('call') === 4 )
                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ url('/operaciones') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('operation*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-tty text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Operaciones</span>
                    </a>
                </li>
            @endif

            @if( session('call') === 6 )
                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ url('/recepcion') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('recepcion*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-tty text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Recepción</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ route('asistencia_diaria') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('asistencia_diaria*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-commenting-o text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Asistencia diaria</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ route('agendamiento_diario') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('agendamiento_diario*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-commenting-o text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Agendamientos</span>
                    </a>
                </li>
            @endif

            @can('create', new \App\Models\OrderRequest\OcOrderRequest )
                <li x-data="{ expanded: false }" class="mt-0.5 w-full">
                    <a @click="expanded = ! expanded"
                       class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="#">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('solicitud*') || Request::is('listado-solicitud-de-pedidos*') || Request::is('data-solicitud-de-pedidos*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-text-o"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            Solicitud de Pedido
                        </span>
                        <div x-show="expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('solicitud*') || Request::is('listado-solicitud-de-pedidos*') || Request::is('data-solicitud-de-pedidos*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-up }}"></i>
                        </div>
                        <div x-show="!expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('solicitud*') || Request::is('listado-solicitud-de-pedidos*') || Request::is('data-solicitud-de-pedidos*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-down }}"></i>
                        </div>
                        <div x-show="expanded" x-collapse.duration.1000ms
                             class="items-center border border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">
                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route('order.request') }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('solicitud*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-text-o"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            Solicitudes
                        </span>
                            </a>
                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'order.request.list' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('listado-solicitud-de-pedidos*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-check"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Aprobación de Pedidos
                                </span>
                            </a>
                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'export.order.request' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('data-solicitud-de-pedidos*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-excel-o"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                Detalle Sol. Pedido
                            </span>
                            </a>
                        </div>
                    </a>
                </li>
                @endcan

                    <li x-data="{ expanded: false }" class="mt-0.5 w-full">
                        <a @click="expanded = ! expanded"
                           class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                           href="#">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class=" {{ Request::is('orden-de-compra*') || Request::is('listado-ordenes-de-compra*') || Request::is('data-ordenes-de-compra*') || Request::is('listado-asignacion-de-precios*') || Request::is('articulos-con-stock*') || Request::is('ordenes-de-compra-por-recepcionar*') || Request::is('*proveedores*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-cart-arrow-down"></i>
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            Orden de Compra
                        </span>
                            <div x-show="expanded"
                                 class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class="{{ Request::is('orden-de-compra*') || Request::is('listado-ordenes-de-compra*') || Request::is('data-ordenes-de-compra*') || Request::is('listado-asignacion-de-precios*') || Request::is('articulos-con-stock*') || Request::is('ordenes-de-compra-por-recepcionar*') || Request::is('proveedores*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-up }}"></i>
                            </div>
                            <div x-show="!expanded"
                                 class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class="{{ Request::is('orden-de-compra*') || Request::is('listado-ordenes-de-compra*') || Request::is('data-ordenes-de-compra*') || Request::is('listado-asignacion-de-precios*') || Request::is('articulos-con-stock*') || Request::is('ordenes-de-compra-por-recepcionar*') || Request::is('proveedores*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-down }}"></i>
                            </div>
                            <div x-show="expanded" x-collapse.duration.1000ms class="items-center border border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                   href="{{ route('purchase-order') }}">
                                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class=" {{ Request::is('orden-de-compra*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-excel-o"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Orden
                                    </span>
                                </a>

                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                   href="{{ route('purchase.order.list') }}">
                                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class=" {{ Request::is('listado-ordenes-de-compra*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-list-alt"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Aprobaciones OC
                                    </span>
                                </a>

                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                   href="{{ route('export.purchase.order') }}">
                                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class="{{ Request::is('data-ordenes-de-compra*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-excel-o"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Detalle OC
                                    </span>
                                </a>

{{--                                Estos dos submenu son para los quotegenerator--}}
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                   href="{{ route('purchaseorder.prices.assignment.list') }}">
                                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class="{{ Request::is('listado-asignacion-de-precios*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-dollar"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Asignación de Precios
                                    </span>
                                </a>

                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                   href="{{ route('items.in.stock') }}">
                                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class="{{ Request::is('articulos-con-stock*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-shopping-basket"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Articulos con Stock
                                    </span>
                                </a>

                                @can('view', new \App\Models\PurchaseOrder\Receptionist )
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                   href="{{ route('purchaseorder.list.to.receive') }}">
                                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class="{{ Request::is('ordenes-de-compra-por-recepcionar*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-list-alt"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        OC x Recepcionar
                                    </span>
                                </a>
                                @endcan


                                @can('create', new \App\Models\PurchaseOrder\OcPurchaseOrder )

                                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                       href="{{ route('purchase.order.provider') }}">
                                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                            <i class="{{ Request::is('proveedores*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-cubes"></i>
                                        </div>
                                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Proveedores
                                    </span>
                                    </a>
                                @endcan
                            </div>
                        </a>
                    </li>

                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ route( 'reception.list' ) }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('receprion-list*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-list"></i>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease">Voucher</span>
                    </a>
                </li>






            @can('view', new App\Models\OrderRequest\OcProduct)
                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ route( 'purchaseorder.form.create.product' ) }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('*producto*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-tag"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Articulos</span>
                    </a>
                </li>
            @endcan

            @can('view', new App\Models\OrderRequest\OcCategory)
                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ route( 'purchaseorder.form.category.subcategory' ) }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('sol-configuracion*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-cubes"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Categoria</span>
                    </a>
                </li>
            @endcan

                <li x-data="{ expanded: false }" class="mt-0.5 w-full">
                    <a @click="expanded = ! expanded"
                       class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="#">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('lead*') || Request::is('lead-used*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-commenting-o"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            Lead Landbot
                        </span>
                        <div x-show="expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('lead*') || Request::is('lead-used*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-up }}"></i>
                        </div>
                        <div x-show="!expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('lead*') || Request::is('lead-used*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-down }}"></i>
                        </div>
                        <div x-show="expanded" x-collapse.duration.1000ms
                             class="items-center border border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'lead' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('lead') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-archive"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Landbot
                                </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'lead.used' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('lead-used*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-archive"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Landbot Usados
                                </span>
                            </a>

                        </div>
                    </a>
                </li>

                <li x-data="{ expanded: false }" class="mt-0.5 w-full">
                    <a @click="expanded = ! expanded"
                       class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="#">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('formulario-caja-chica*') || Request::is('listado-registros-caja-chica*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-archive"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            Caja Chica
                        </span>
                        <div x-show="expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('formulario-caja-chica*') || Request::is('listado-registros-caja-chica*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-up }}"></i>
                        </div>
                        <div x-show="!expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('formulario-caja-chica*') || Request::is('listado-registros-caja-chica*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-down }}"></i>
                        </div>
                        <div x-show="expanded" x-collapse.duration.1000ms
                             class="items-center border border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'cash.form' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('formulario-caja-chica*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-archive"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Caja
                                </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'cash.list' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('listado-registros-caja-chica*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-check-square-o"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Listado de Rendiciones
                                </span>
                            </a>

                        </div>
                    </a>
                </li>


                <li x-data="{ expanded: false }" class="mt-0.5 w-full">
                    <a @click="expanded = ! expanded"
                       class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="#">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('usuarios*') || Request::is('formulario-roles*') || Request::is('formulario-asignacion-permisos-a-roles*') || Request::is('formulario-de-usuarios*') || Request::is('formulario-asignacion-sucursales-a-usuario*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-users"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            Mantenedor de Usuarios
                        </span>
                        <div x-show="expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('usuarios*') || Request::is('formulario-roles*') || Request::is('formulario-asignacion-permisos-a-roles*') || Request::is('formulario-de-usuarios*') || Request::is('formulario-asignacion-sucursales-a-usuario*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-up }}"></i>
                        </div>
                        <div x-show="!expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('usuarios*') || Request::is('formulario-roles*') || Request::is('formulario-asignacion-permisos-a-roles*') || Request::is('formulario-de-usuarios*') || Request::is('formulario-asignacion-sucursales-a-usuario*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-down }}"></i>
                        </div>
                        <div x-show="expanded" x-collapse.duration.1000ms
                             class="items-center border border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'maintainer.users' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('usuarios*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-users"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Listado de Usuarios
                                </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'maintainer.user' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('formulario-de-usuarios*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-user"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Creación de Usuarios
                                </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'maintainer.roles' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('formulario-roles*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-user-plus"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Creación de Roles
                                </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'maintainer.permission.for.roles' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('formulario-asignacion-permisos-a-roles*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-check-square-o"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Asignación Permisos a Roles
                                </span>
                            </a>

                        </div>
                    </a>
                </li>

                <li x-data="{ expanded: false }" class="mt-0.5 w-full">
                    <a @click="expanded = ! expanded"
                       class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="#">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('creacion-articulos-ti*') || Request::is('registro-inventario-ti*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-laptop"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            Inventario TI
                        </span>
                        <div x-show="expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('creacion-articulos-ti*') || Request::is('registro-inventario-ti*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-up }}"></i>
                        </div>
                        <div x-show="!expanded"
                             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="{{ Request::is('creacion-articulos-ti*') || Request::is('registro-inventario-ti*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-down }}"></i>
                        </div>
                        <div x-show="expanded" x-collapse.duration.1000ms
                             class="items-center border border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'form.articles.ti' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('creacion-articulos-ti*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-mouse-pointer"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Articulos TI
                                </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'form.inventory.ti' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('registro-inventario-ti*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-pencil-square-o"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Ingreso Inventario TI
                                </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route( 'inventory.ti' ) }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('inventario-ti*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-table"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Inventario TI
                                </span>
                            </a>

                        </div>
                    </a>
                </li>
        </ul>
    </div>

</aside>
