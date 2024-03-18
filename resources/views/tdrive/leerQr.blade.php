<x-app-layout>
    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="overflow-x-auto" style="padding: 20px;">
                        <h2>Escanear QR</h2>
                        <p>Al escanear el QR de un vehículo , se comprobará los datos de este en los flujos de TDRIVE,  si el vehículo está en proceso de Taller,  se iniciarán los trabajos de acuerdo al perfil del usuario que escanea el QR</p>
                        <video id="webcam1" width="100%" class="border-blue-500 border-2"></video>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{asset('js/instascan/adapter.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/instascan/vue.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/instascan/instascan.min.js')}}"></script>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('webcam1')});
        let snd = new Audio('{{ asset('assets/sound/beep.mp3') }}');

        Instascan.Camera.getCameras().then(function (cameras){
           if(cameras.length > 0 )
           {
               if(cameras.length > 1 )
               {
                   scanner.start(cameras[1]);
               }
               else {
                   scanner.start(cameras[0]);
               }
           }else {
               alert('No hay camaras web activas');
           }
        }).catch(function (e){
            console.error(e);
        });

        scanner.addListener('scan',function (c){
            // Lee QR y envía a la función de orquestación del QR
            snd.play();
            enviaQR(c);
        });


        function enviaQR(valorQR)
        {
            // Comprueba la integridad del qr
                $.ajax({
                    url: '{{route('compruebaQR')}}',
                    type: 'GET',
                    data: {'valor': valorQR , 'tipo' : 'Comprobar'},
                    success: function (data) {

                        Swal.fire({
                            title: data.titulo,
                            text: data.texto,
                            icon: data.icono,
                            showCancelButton: data.cancelbutton,
                            confirmButtonText: 'Aceptar',
                            cancelButtonText: `Cancelar`,
                        }).then((respuesta) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (respuesta.isConfirmed && data.cancelbutton) {

                                $.ajax({
                                    url: '{{route('compruebaQR')}}',
                                    type: 'GET',
                                    data: {'valor': valorQR , 'tipo' : 'Enviar'},
                                    success: function (result) {
                                        if(result.icono == 'redirect')
                                        {
                                            window.location.href = result.titulo;
                                        }
                                        else
                                        {
                                            Swal.fire({
                                                title: result.titulo,
                                                text: result.texto,
                                                showCancelButton: false,
                                                icon: 'success',
                                                confirmButtonText: 'Ok',
                                            });
                                        }
                                    }
                                });
                            }
                        });
                    }
                });


        }
    </script>
</x-app-layout>
