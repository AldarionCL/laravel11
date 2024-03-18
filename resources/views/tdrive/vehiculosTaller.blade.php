<x-app-layout>

    <livewire:tdrive.indicadores.indicador-tdrive />

    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <h4 class="card-title">@yield('title-header', 'Vehículos en DyP ') </h4>
                            </div>

                            @if(@$mensaje != '')
                                @if($error)
                                    <div class="relative w-full p-4 text-white bg-orange-500 rounded-lg">{{$mensaje}}</div>
                                @else
                                    <div class="relative w-full p-4 text-white rounded-lg bg-emerald-500">{{$mensaje}}</div>
                                @endif
                            @endif

                            <div class="flex flex-col overflow-x-auto">
                                <div class="sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                       <div class="flex flex-row">
                                           <div class="w-1/3 ml-3 ">
                                               <label for="searchSucursal" class="font-bold">Sucursal: </label>
                                               <select name="searchSucursal" id="searchSucursal"
                                                       class=" w-full focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                   @foreach($sucursales as $g)
                                                       <option {{($sucursal->ID == $g["ID"]) ? 'selected' : ''}} value="{{$g["ID"]}}">{{$g["Sucursal"]}}</option>
                                                   @endforeach
                                               </select>
                                           </div>

                                       </div>

                                        <div class="overflow-x-auto">
                                            <livewire:tdrive.componentes.modales.taller-grid : idSucursal="{{$sucursal->ID}}" idTdrive="{{$idTdrive}}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script >
        $('#searchSucursal').on('change', function ( )
        {
            let sucursal = $('#searchSucursal').val();
            window.location.href = "/tdrive/vehiculostaller/"+sucursal;
        });
    </script>
</x-app-layout>



