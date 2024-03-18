<li x-data="{ expanded: false }" class="mt-0.5 w-full">
    <a @click="expanded = ! expanded"
       class=" dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
       href="#">
        <div
            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class=" {{ Request::is('operation*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-slate-700 text-size-sm fa fa-truck"></i>
        </div>
        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">
                            Operaciones
                        </span>
        <div x-show="expanded"
             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="{{ Request::is('operation*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-up }}"></i>
        </div>
        <div x-show="!expanded"
             class="mr-2 flex h-8 w-full items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="{{ Request::is('operation*') ? 'text-orange-500' : '' }} relative top-0 leading-normal text-size-sm fa fa-chevron-down }}"></i>
        </div>
        <div x-show="expanded" x-collapse.duration.1000ms
             class="items-center dark:bg-slate-850 border-t-0 z-100 rounded-b-lg p-1 bg-gray-100 p-2 group-hover:visible w-full">

            {{-- sub menu 3 nivel --}}
            <ul>
                @if( session('call') === 4 )
                    <li class="mt-0.5 w-full">
                        <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                           href="{{ url('/operaciones') }}">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class=" {{ Request::is('operation*') ? 'text-orange-500' : '' }} relative top-0 leading-normal fa fa-tty text-size-sm"></i>
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mesa de Ayuda</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </a>
</li>
