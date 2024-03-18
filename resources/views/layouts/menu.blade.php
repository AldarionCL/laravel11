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
           @elseif( session('call') === 8 )/cpd
           @elseif( session('call') === 9 )/tdrive
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

            @include('layouts.menu-dyp')
            @include('layouts.menu-cpd')
            @include('layouts.menu-testdrive')

            @if( session('call') != 7 &&  session('call') != 8 &&  session('call') != 9 )
{{--
                @include('layouts.menu-landbot')
--}}
                @include('layouts.menu-mkt')
                @include('layouts.menu-operation')
                @include('layouts.menu-catering')
                @include('layouts.menu-accounting')
                @include('layouts.menu-ti')
            @endif
        </ul>
    </div>

</aside>
