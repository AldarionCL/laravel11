@if( session('call') === 7 )
    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/dyp/nuevodyp') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('dyp/nuevodyp*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-address-book-o text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Crear DyP</span>
        </a>
    </li>

    <li class="mt-0.5 w-full">
        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
           href="{{ url('/dyp') }}">
            <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class=" {{ Request::is('dyp') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-tasks text-size-sm"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Lista DyP</span>
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
           href="{{ url('/dyp/vehiculostaller') }}">
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
