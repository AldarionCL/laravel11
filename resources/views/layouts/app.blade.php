<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.png" />
    <title>@yield('title', 'Home') | Roma</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    {{--<link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />--}}
    <!-- Popper -->
    {{--<script src="https://unpkg.com/@popperjs/core@2"></script>--}}
    <!-- Main Styling -->
{{--    <link href="./assets/css/argon-dashboard-tailwind.css?v=1.0.0" rel="stylesheet" />--}}

    <!-- Scripts -->
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
{{--
    @livewire('livewire-ui-modal')
--}}


{{--
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
--}}

<style>

    [x-cloak] {
        display: none !important;
    }
</style>


</head>

<body class="m-0 font-sans antialiased font-normal dark:bg-slate-900 text-size-base leading-default bg-gray-50 text-slate-500">
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
<!-- Optional JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

@include('layouts.menu')

<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">

    @include('layouts.navbar')

    <div class="w-full px-6 mx-auto">
        @yield('stadistics')
        {{ @$slot }}
        @include('layouts.footer')
    </div>
</main>


@livewire('livewire-ui-modal')
@livewireScripts

{{--<script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/apexcharts"></script>--}}

<script>
    window.addEventListener('swal:success', event => {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: event.detail.type,
            title: event.detail.message
        })
    });

    window.livewire.onError( statusCode => {

        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        if ( statusCode === 500 ){
            Toast.fire({
                icon: "error",
                title: "A ocurrido un error en el sistema, favor comunicarse con soporte"
            })
        }
        return false
    })

    Livewire.on('refreshFilters', postId => {
        Livewire.emit('refreshDatatable')
    })

    // Livewire.on('postAdded', postId => {
    //     $openModal('myModal')
    // })

</script>
<script type="module">
    /*Echo.private('channel-landbot')
        .listen('MessageLandbotEvent', (e) => {
            console.log(e);
        });*/

    Echo.private('App.Models.User.{{ auth()->user()->ID ?? 1 }}')
        .notification((notification) => {
            const notify = document.getElementById('notify');

            // console.log( notify.innerText );
            const total = notify.innerText !== '' ? parseInt( notify.innerText ) + 1 : 1;
            // console.log(total);
            notify.textContent = total.toString();

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: notification.icon,
                title: notification.message
            })

        });
</script>

<script>
    function imprSelec(nombre) {
        var ficha = document.getElementById(nombre);
        var ventimp = window.open(' ', 'popimpr');
        ventimp.document.write( ficha.innerHTML );
        ventimp.document.close();
        ventimp.print( );
        ventimp.close();
    }

    /*$(document).ready(function() {
        $.ajax({
            url: 'http://roma.pompeyo.cl/respaldo/htmlv1/loginLaravel.html',
            type: 'GET',
                data: {
                    email: 'cristian.fuentealba@pompeyo.cl',
                    pass: 'ne0l0gik'
                },
            success: function(data) {
                console.log(data);
            }
        });
    });*/
</script>
</body>
</html>
