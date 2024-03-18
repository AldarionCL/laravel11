@if( session('call') === 9 )
    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/tdrive/nuevotdrive') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('tdrive/nuevotdrive*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-address-book-o text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Crear TestDrive</span>
        </a>
    </li>

    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/tdrive') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('tdrive') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-tasks text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Lista TestDrive</span>
        </a>
    </li>

    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/tdrive/mistareas') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('tdrive/mistareas*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-folder-open-o  text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mis tareas</span>
        </a>
        <ul class=" ml-4 flex flex-col pl-0 mb-0">
            <li class=" w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                   href="{{ url('/tdrives/leerQr') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class=" {{ Request::is('tdrives/leerQr*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-qrcode text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Iniciar/Terminar Trabajo</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/tdrive/vehiculostaller/285') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('tdrive/vehiculostaller*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-building-o  text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Vehículos en patio</span>
        </a>
    </li>

    <li class="mt-0.5 w-full">
        <div class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('tdrive/reporte*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-ticket text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Reportes</span>
        </div>
        <ul class=" ml-4 flex flex-col pl-0 mb-0">
            <li class=" w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                   href="{{ url('/tdrive/reporte/etapas') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class=" {{ Request::is('tdrive/reporte/etapas*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-clock-o text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Tiempos por etapa</span>
                </a>
            </li>
        </ul>
    </li>


@endif
