<li x-data="{ expanded: false }" class="mt-0.5 w-full">
    <a @click="expanded = ! expanded"
       class=" dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
       href="#">
        <div
            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class=" {{ Request::is('usuarios*') || Request::is('formulario-roles*') || Request::is('formulario-asignacion-permisos-a-roles*') || Request::is('formulario-de-usuarios*') || Request::is('formulario-asignacion-sucursales-a-usuario*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-laptop"></i>
        </div>
        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            TI
                        </span>
        <div x-show="expanded"
             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="{{ Request::is('usuarios*') || Request::is('formulario-roles*') || Request::is('formulario-asignacion-permisos-a-roles*') || Request::is('formulario-de-usuarios*') || Request::is('formulario-asignacion-sucursales-a-usuario*')  ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-up }}"></i>
        </div>
        <div x-show="!expanded"
             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="{{ Request::is('usuarios*') || Request::is('formulario-roles*') || Request::is('formulario-asignacion-permisos-a-roles*') || Request::is('formulario-de-usuarios*') || Request::is('formulario-asignacion-sucursales-a-usuario*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-down }}"></i>
        </div>
        <div x-show="expanded" x-collapse.duration.1000ms
             class="items-center dark:bg-slate-850 border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

            {{-- sub menu 3 nivel --}}
            <ul>
                    @if( session('call') === 0 || session('call') === 2 )
                        <li class="mt-0.5 w-full">
                            <a class="dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                               href="{{ url('/ticket') }}">
                                <div
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class=" {{ Request::is('ticket*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-ticket text-size-sm"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mesa de Ayuda</span>
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
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mesa de Ayuda</span>
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
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mesa de Ayuda</span>
                            </a>
                        </li>
                    @endif

                        <li x-data="{ expanded: false }" class="mt-0.5 w-full">
                            <a @click="expanded = ! expanded"
                               class=" dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
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
                                     class="items-center dark:bg-slate-850 border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

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
                               class=" dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
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
                                     class="items-center dark:bg-slate-850 border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

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
    </a>
</li>
