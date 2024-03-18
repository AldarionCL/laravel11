<div id="patio" class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border dark:bg-blue-950 dark:text-gray-50">
    <form id="guardarPuesto" name="guardarPuesto" class="card" action="{{route('asignarpuesto')}}" method="post">
        @csrf
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl dark:bg-blue-950 dark:text-gray-50">
            <h6>Mapa de puestos</h6>
            <button type="button" onclick="click_puesto('|')" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                Vehículo fuera de patio
            </button>
            <input type="hidden" name="idTdrive"  id="idTdrive" wire:model="idTdrive">
            <input type="hidden" name="puesto" id="puesto" wire:model="puesto">
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="p-2 table-bordered  w-full text-center text-xs border-1">
                    <tbody>
                    @for($i=1; $i<=$filas; $i++)
                        <tr class="fila{{$i}} h-16">
                            @for($col=1; $col<=$columnas; $col++)
                                <td onclick="click_puesto('{{$letras[$col].$i.'|'.@$matriz[$letras[$col].$i]["tdrive"]}}')" style="min-width: 100px;" class=" {{(isset($matriz[$letras[$col].$i]["patente"]))? 'bg-green-200 text-black' : 'hover:text-blue-900'}} rounded-lg hover:bg-blue-100 border border-1 border-gray-300 p-1" id="fila_{{$i}}{{$letras[$col]}}" >
                                    <small>
                                        <span class="fa {{(isset($matriz[$letras[$col].$i]["patente"])) ? 'fa-car' : ''}} text-lg"> </span> &nbsp;{{$letras[$col].$i}}
                                        <p class="font-bold @if(isset($matriz[$letras[$col].$i]["patente"])) p-2 bg-white rounded border-black border-2 @endif"> {{(isset($matriz[$letras[$col].$i]["patente"])) ? formato_patente(@$matriz[$letras[$col].$i]["patente"]) : ''}}</p>
                                    </small>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                    </tbody>
                </table>

                <button id="asignarPuesto" type="submit" class="hidden inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Asignar puesto</button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function click_puesto(data)
    {
        let tdrive = $('#idTdrive').val();

        let split = data.split('|');

        if(split[1] != '' )
        {
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
            });
            let titulo = 'Sitio actualmente utilizado por otro vehículo.';
            let texto= 'Quiere ir al detalle del Tdrive?';

            if(tdrive == '')
            {
                titulo = 'Quiere ir al detalle del Tdrive?';
                texto = '';
            }

            Toast.fire({
                icon: 'warning',
                title: titulo,
                text: texto,
                showConfirmButton:true,
                confirmButtonText: "Ir al detalle"
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '/tdrive/'+split[1];
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info');
                }
            })
        }
        else {
            if(tdrive!='')
            {
                $('#puesto').val(split[0]);

                Swal.fire({
                    icon: 'question',
                    title: 'Puesto ' + split[0] +' escogido',
                    text: 'Quiere asignar este puesto para el vehículo?',
                    showCancelButton: true,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        let data = {
                            'idTdrive': '{{@$idTdrive}}',
                            'puesto': split[0]
                        };

                        $.ajax({
                            url: '{{route('asignarpuesto')}}/?idTdrive='+'{{@$idTdrive}}'+'&puesto='+split[0],
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: data,
                            success: function (result) {
                                Swal.fire(result.mensaje, '', 'info');

                                $("#patio").load(location.href+" #patio>*","");
                            }
                        });
                    }
                });
            }

        }
    }

</script>


