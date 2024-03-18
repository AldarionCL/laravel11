<li x-data="{ expanded: false }" class="mt-0.5 w-full">
    <a @click="expanded = ! expanded"
       class=" dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
       href="#">
        <div
            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class=" {{ Request::is('orden-de-compra*') || Request::is('listado-ordenes-de-compra*') || Request::is('data-ordenes-de-compra*') || Request::is('listado-asignacion-de-precios*') || Request::is('articulos-con-stock*') || Request::is('*proveedores*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-cubes"></i>
        </div>
        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            Abastecimiento
                        </span>
        <div x-show="expanded"
             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="{{ Request::is('orden-de-compra*') || Request::is('listado-ordenes-de-compra*') || Request::is('data-ordenes-de-compra*') || Request::is('listado-asignacion-de-precios*') || Request::is('articulos-con-stock*') || Request::is('proveedores*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-up }}"></i>
        </div>
        <div x-show="!expanded"
             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="{{ Request::is('orden-de-compra*') || Request::is('listado-ordenes-de-compra*') || Request::is('data-ordenes-de-compra*') || Request::is('listado-asignacion-de-precios*') || Request::is('articulos-con-stock*') || Request::is('proveedores*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-down }}"></i>
        </div>
        <div x-show="expanded" x-collapse.duration.1000ms
             class="items-center dark:bg-slate-850 border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

            {{-- sub menu 3 nivel --}}
            <ul>
                @can('create', new \App\Models\OrderRequest\OcOrderRequest )
                    <li x-data="{ expanded: false }" class="mt-0.5 w-full">
                        <a @click="expanded = ! expanded"
                           class=" dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                           href="#">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class=" {{ Request::is('solicitud*') || Request::is('listado-solicitud-de-pedidos*') || Request::is('data-solicitud-de-pedidos*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-text-o"></i>
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                Solicitud de Compra
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
                                 class="items-center dark:bg-slate-850 border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                   href="{{ route('order.request') }}">
                                    <div
                                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class=" {{ Request::is('solicitud*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-text-o"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Nueva Solicitud
                                    </span>
                                </a>
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                   href="{{ route( 'order.request.list' ) }}">
                                    <div
                                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class=" {{ Request::is('listado-solicitud-de-pedidos*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-check"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                    Aprobación de Solicitud
                                </span>
                                </a>
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                   href="{{ route( 'export.order.request' ) }}">
                                    <div
                                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class=" {{ Request::is('data-solicitud-de-pedidos*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-excel-o"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                Detalle Sol. de Compra
                            </span>
                                </a>
                            </div>
                        </a>
                    </li>
                @endcan
                <li x-data="{ expanded: false }" class="mt-0.5 w-full">
                    <a @click="expanded = ! expanded"
                       class=" dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
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
                        <div x-show="expanded" x-collapse.duration.1000ms
                             class="items-center dark:bg-slate-850 border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route('purchase-order') }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('orden-de-compra*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-excel-o"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Generar Orden de Compra
                                    </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route('purchase.order.list') }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('listado-ordenes-de-compra*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-list-alt"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Aprobaciones OC
                                    </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route('export.purchase.order') }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class="{{ Request::is('data-ordenes-de-compra*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-file-excel-o"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Detalle OC
                                    </span>
                            </a>

                            {{--                                Estos dos submenu son para los quotegenerator--}}
                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route('purchaseorder.prices.assignment.list') }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class="{{ Request::is('listado-asignacion-de-precios*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-dollar"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Asignación de Precios
                                    </span>
                            </a>

                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ route('items.in.stock') }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class="{{ Request::is('articulos-con-stock*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-shopping-basket"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Articulos con Stock
                                    </span>
                            </a>

                        </div>
                    </a>
                </li>

                @can('view', new \App\Models\PurchaseOrder\Receptionist )
                    <li class="mt-0.5 w-full">
                        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                           href="{{ route('purchaseorder.list.to.receive') }}">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class="{{ Request::is('ordenes-de-compra-por-recepcionar*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-list-alt"></i>
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Recepción Articulos y Servicios
                                    </span>
                        </a>
                    </li>
                @endcan

                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                       href="{{ route( 'reception.list' ) }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class=" {{ Request::is('receprion-list*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-list"></i>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease">Voucher Contable</span>
                    </a>
                </li>

                @can('create', new \App\Models\PurchaseOrder\OcPurchaseOrder )
                    <li class="mt-0.5 w-full">
                        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                           href="{{ route('purchase.order.provider') }}">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class="{{ Request::is('proveedores*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-cubes"></i>
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                                        Proveedores
                                    </span>
                        </a>
                    </li>
                @endcan

                @can('view', new \App\Models\OrderRequest\OcProduct)
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

                @can('view', new \App\Models\OrderRequest\OcCategory)
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
            </ul>

        </div>
    </a>
</li>
