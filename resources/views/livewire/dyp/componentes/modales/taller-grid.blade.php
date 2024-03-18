<div id="patio" class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">

    <form id="guardarPuesto" name="guardarPuesto" class="card" action="{{route('asignarpuesto')}}" method="post">
        @csrf
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Mapa de puestos</h6>
            <button type="button" onclick="click_puesto('|')" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                Vehículo fuera de patio
            </button>
            <input type="hidden" name="idDyp"  id="idDyp" wire:model="idDyp">
            <input type="hidden" name="puesto" id="puesto" wire:model="puesto">
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">

                <table class="p-2 table-bordered  w-full text-center text-xs border-1">
                    <tbody>
                        <tr class="fila0 h-16">
                            @foreach($titulos["patio1"][0] as $col => $titulo)
                                <td style="min-width: 80px;" class="font-bold bg-blue-200 rounded-xs hover:bg-blue-100 border border-1 border-gray-300 p-1">
                                    @if($titulo!='')
                                        <div>
                                            <small>
                                                <span class="text-lg"> </span> &nbsp;{{$titulo}}
                                                <p class="font-bold"></p>
                                            </small>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                    @foreach($puestos["patio1"] as $key => $puesto)
                        <tr class="fila{{$col}} h-16" style="vertical-align: super;">
                            @foreach($puesto as $col => $td)
                                <td @if($td != '') onclick="click_puesto('{{$td}}|{{(isset($matriz[$td]))?$matriz[$td]["dyp"] : ''}}')" @endif
                                    style="min-width: 100px;" class=" {{($td=='')? 'bg-slate-200': 'hover:bg-blue-100' }} drop rounded-lg border border-1 border-gray-300 p-1" id="fila_{{$td}}" >
                                    @if($td != '')
                                        <div class="bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-semibold  px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-slate-400  items-center justify-center"
                                             style="float: left; position: relative; top: -5px; left:-4px;">
                                            <span>{{$td}}</span>
                                        </div>
                                    @endif
                                    @if(isset($matriz[$td]))
                                        <div draggable="true" class="drag {{(isset($matriz[$td]["patente"]))? 'bg-green-200 text-black' : 'hover:text-blue-900'}} rounded"
                                             data-id="{{@$matriz[$td]["dyp"]}}">
                                            <small style="margin: 0px;">
                                                <span class="fa fa-car text-lg"> </span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                <div class="font-bold @if(isset($matriz[$td]["patente"])) p-2 bg-white rounded border-black border-2 @endif"> {{(isset($matriz[$td]["patente"])) ? (@$matriz[$td]["patente"]) : ''}}</div>
                                            </small>
                                            <span class="text-xs"><small><small>DYP {{@$matriz[$td]["dyp"]}}</small></small></span>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>



                <table class="p-2 table-bordered  w-full text-center text-xs border-1">
                    <tbody>
                    <tr class="fila0 h-16">
                        @foreach($titulos["patio2"][0] as $col => $titulo)
                            <td style="min-width: 80px;" class="font-bold bg-blue-200 rounded-xs hover:bg-blue-100 border border-1 border-gray-300 p-1">
                                @if($titulo!='')
                                    <div>
                                        <small>
                                            <span class="text-lg"> </span> &nbsp;{{$titulo}}
                                            <p class="font-bold"></p>
                                        </small>
                                    </div>
                                @endif
                            </td>
                        @endforeach
                    </tr>

                    @foreach($puestos["patio2"] as $key => $puesto)
                        <tr class="fila{{$col}} h-16" style="vertical-align: super;">
                            @foreach($puesto as $col => $td)
                                <td @if($td != '') onclick="click_puesto('{{$td}}|{{(isset($matriz[$td]))?$matriz[$td]["dyp"] : ''}}')" @endif
                                style="min-width: 100px;" class=" {{($td=='')? 'bg-slate-200': 'hover:bg-blue-100' }} drop rounded-lg border border-1 border-gray-300 p-1" id="fila_{{$td}}" >
                                    @if($td != '')
                                        <div class="bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-semibold  px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-slate-400  items-center justify-center"
                                             style="float: left; position: relative; top: -5px; left:-4px;">
                                            <span>{{$td}}</span>
                                        </div>
                                    @endif
                                    @if(isset($matriz[$td]))
                                        <div draggable="true" class="drag {{(isset($matriz[$td]["patente"]))? 'bg-green-200 text-black' : 'hover:text-blue-900'}} rounded"
                                             data-id="{{@$matriz[$td]["dyp"]}}">
                                            <small style="margin: 0px;">
                                                <span class="fa fa-car text-lg"> </span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                <div class="font-bold @if(isset($matriz[$td]["patente"])) p-2 bg-white rounded border-black border-2 @endif"> {{(isset($matriz[$td]["patente"])) ? (@$matriz[$td]["patente"]) : ''}}</div>
                                            </small>
                                            <span class="text-xs"><small><small>DYP {{@$matriz[$td]["dyp"]}}</small></small></span>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <button id="asignarPuesto" type="submit" class="hidden inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Asignar puesto</button>
            </div>
        </div>

    </form>

<style>
    .caja_patente{
        margin: 5px;
        min-width: 80px;
        width: 100%;
    }
</style>



</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let dragTemp;

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


    $('.drag').on('dragstart',function(e){
        dragTemp = e.target;
        console.log('dragStart',dragTemp);
    })

    $('.drop').on('dragover', function(e){
        e.preventDefault();
    })

    @foreach($puestos["patio1"] as $key => $puesto)
        @foreach($puesto as $col => $td)

            $('#fila_{{$td}}').on('drop',function(){
                this.appendChild( dragTemp )
                $('#fila_{{$td}}').children('.drag').each(function() {

                    // actualizar posición
                    console.log('DYP ID:',$(this).data('id'));
                    console.log('Posicion:','{{$td}}');
                    // llama a la funcion de actualizar puesto por ajax
                    $.ajax({
                        url: '{{route('actualizarpuestodyp')}}',
                        type: 'POST',
                        data: {
                            'idDyp': $(this).data('id'),
                            'puesto': '{{$td}}'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log('Resultado:',result);
                            if(result === 'ok')
                            {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Puesto actualizado'
                                });
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Puesto ocupado',
                                    text: 'Escoja otro puesto libre para el vehículo',
                                    showCancelButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            }
                        }
                    });

                })
            })
      @endforeach
    @endforeach

      @foreach($puestos["patio2"] as $key => $puesto)
      @foreach($puesto as $col => $td)

      $('#fila_{{$td}}').on('drop',function(){
          this.appendChild( dragTemp )
          $('#fila_{{$td}}').children('.drag').each(function() {

              // actualizar posición
              console.log('DYP ID:',$(this).data('id'));
              console.log('Posicion:','{{$td}}');
              // llama a la funcion de actualizar puesto por ajax
              $.ajax({
                  url: '{{route('actualizarpuestodyp')}}',
                  type: 'POST',
                  data: {
                      'idDyp': $(this).data('id'),
                      'puesto': '{{$td}}'
                  },
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function (result) {
                      console.log('Resultado:',result);
                      if(result === 'ok')
                      {
                          Toast.fire({
                              icon: 'success',
                              title: 'Puesto actualizado'
                          });
                      }else{
                          Swal.fire({
                              icon: 'warning',
                              title: 'Puesto ocupado',
                              text: 'Escoja otro puesto libre para el vehículo',
                              showCancelButton: false,
                              allowOutsideClick: false,
                              allowEscapeKey: false,
                          }).then((result) => {
                              /* Read more about isConfirmed, isDenied below */
                              if (result.isConfirmed) {
                                  location.reload();
                              }
                          });
                      }
                  }
              });

          })
      })
    @endforeach
    @endforeach


    function click_puesto(data)
    {
        let dyp = $('#idDyp').val();

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
            let texto= 'Quiere ir al detalle del Dyp?';

            if(dyp == '')
            {
                titulo = 'Quiere ir al detalle del Dyp?';
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
                    window.location.href = '/dyp/flujo/'+split[1];
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info');
                }
            })
        }
        else {
            if(dyp!='')
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
                            'idDyp': '{{@$idDyp}}',
                            'puesto': split[0]
                        };

                        $.ajax({
                            url: '{{route('asignarpuesto')}}/?idDyp='+'{{@$idDyp}}'+'&puesto='+split[0],
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


