@if( session('call') === 8 )
    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/cpd/nuevocpd') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('cpd/nuevocpd*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-address-book-o text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Crear Cpd</span>
        </a>
    </li>

    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/cpd') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('cpd') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-tasks text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Lista Cpd</span>
        </a>
    </li>

    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/cpd/mistareas') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('cpd/mistareas*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-folder-open-o  text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mis tareas</span>
        </a>
        <ul class=" ml-4 flex flex-col pl-0 mb-0">
            <li class=" w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                   href="{{ url('/cpds/leerQr') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class=" {{ Request::is('cpds/leerQr*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-qrcode text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Escanear QR</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/cpd/vehiculostaller/37') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('cpd/vehiculostaller*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-building-o  text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Vehículos en patio</span>
        </a>
    </li>

    <li class="mt-0.5 w-full">
        <div class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('cpd/reporte*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-ticket text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Reportes</span>
        </div>
        <ul class=" ml-4 flex flex-col pl-0 mb-0">
            <li class=" w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                   href="{{ url('/cpd/reporte/etapas') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class=" {{ Request::is('cpd/reporte/etapas*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-clock-o text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Tiempos por etapa</span>
                </a>
            </li>
            <li class=" w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                   href="{{ url('/cpd/reporte/wip') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class=" {{ Request::is('cpd/reporte/wip*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-clock-o text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Tiempos WIP</span>
                </a>
            </li>
            <li class=" w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                   href="{{ url('/cpd/reporte/preparacion') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class=" {{ Request::is('cpd/reporte/preparacion*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-clock-o text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Tiempos Preparación</span>
                </a>
            </li>

            <li class=" w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                   href="{{ url('/cpd/reporte/comite') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class=" {{ Request::is('cpd/reporte/comite*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-users text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Reporte Comité</span>
                </a>
            </li>

            <li class=" w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                   href="{{ url('/cpd/reporte/mayorista') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class=" {{ Request::is('cpd/reporte/mayorista*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-send-o text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Reporte Mayorista</span>
                </a>
            </li>

            <li class=" w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                   href="{{ url('/cpd/reporte/judicial') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class=" {{ Request::is('cpd/reporte/judicial*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-legal text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Reporte Judicial</span>
                </a>
            </li>
        </ul>
    </li>
@endif
