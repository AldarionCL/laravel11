
<div id="OrdenFrame">
    <style >
        @media print {
            input[type=text] {
                border: 2px;
                border-color:  #666666;
                border-style: solid;
            }

            label {
                float:left;
                display: inline-block;
                font-size: 12px;
                font-weight: bold;
                width: 200px;
                max-width: 200px;
                min-width: 200px;
            }

            .divInput{
                float:left;
                display: inline-block;
                width: 400px;
                max-width: 400px;
                min-width: 300px;
            }

            .frameValores label {
                float:left;
                display: inline-block;
                font-size: 12px;
                font-weight: bold;
                width: 150px;
                max-width: 150px;
                min-width: 150px;
            }

            .printHide{
                display: none;
            }

            .frameQR
            {
                font-size: 18px;
            }

            .patente{
                font-size: 20px; margin: 0 auto; font-weight: bold;
            }
        }
    </style>
    <div class="inline-block">
            <img src="{{asset('assets/img/pompeyologo.png')}}" style="margin-left: 10px;" width="350px">
        </div>
        <div class="inline-block" style="text-align: right; float:right;">
            <div class="p-2 w-full">
                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                    <input type="text" value="{{$tdrive->EstadoTdrive}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"/>
                    @error('inputOrdenTrabajo')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                </div>
            </div>
        </div>
        <hr>
    <table class="items-center w-full mb-0 align-top border-gray-200 border-2">
        <tbody>
            <tr>
                <td style="width: 20%;">
                    <div class="frameQR">
                                    <a href="javascript:imprSelec('divQR')" >{{($tdrive->Vin!= null)?generarQR($tdrive->Vin,100) : ''}}</a>
{{--
                        <a href="javascript:imprSelec('divQR')" class="p-4">@if($tdrive->Vin!= null)<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(160)->generate($tdrive->Vin)) !!} "> @endif</a>
--}}
                        <div class="patente">{{formato_patente($tdrive->Patente)}}</div>
                    </div>
                </td>
                <td style="width: 40%;">
                    <div class="frameOT">
                        <div class="p-2 w-full">
                            <label for="inputOrdenTrabajo">N° Orden de trabajo</label>
                            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                <input type="text" name="inputOrdenTrabajo" wire:model="inputOrdenTrabajo" value="{{$inputOrdenTrabajo}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                                @error('inputOrdenTrabajo')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                            </div>
                        </div>

                        <div class="p-2 w-full">
                            <label for="inputSucursal">Sucursal</label>
                            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                <input type="text" name="inputSucursal" wire:model="inputSucursal" value="{{$inputSucursal}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"  required/>
                                @error('inputSucursal')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                            </div>
                        </div>

                        <div class="p-2 w-full">
                            <label for="inputFechaIngreso">Fecha de ingreso</label>
                            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                <input type="text" name="inputFechaIngreso" wire:model="inputFechaIngreso" value="{{$inputFechaIngreso}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"  required/>
                                @error('inputFechaIngreso')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                            </div>
                        </div>

                        <div class="p-2 w-full">
                            <label for="inputFechaAutorizacion">Fecha Autorización Cia</label>
                            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                <input type="text" name="inputFechaAutorizacion" wire:model="inputFechaAutorizacion" value="{{$inputFechaAutorizacion}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                                @error('inputFechaAutorizacion')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                            </div>
                        </div>
                    </div>

                </td>
                <td style="width: 40%;">
                    <div class="frameCIA">
                        <div class="flex flex-wrap w-full">

                            <div class="p-2 w-full">
                                <label for="inputCiaSeguro">Cia Seguros</label>
                                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                    <input type="text" name="inputCiaSeguro" wire:model="inputCiaSeguro" value="{{$inputCiaSeguro}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"  required/>
                                    @error('inputCiaSeguro')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                                </div>
                            </div>

                            <div class="p-2 w-full">
                                <label for="inputLiquidador">Liquidador</label>
                                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                    <input type="text" name="inputLiquidador" wire:model="inputLiquidador" value="{{$inputLiquidador}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                                    @error('inputLiquidador')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                                </div>
                            </div>

                            <div class="p-2 w-full">
                                <label for="inputSiniestro">Siniestro</label>
                                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                    <input type="text" name="inputSiniestro" wire:model="inputSiniestro" value="{{$inputSiniestro}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                                    @error('inputSiniestro')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                                </div>
                            </div>

                            <div class="p-2 w-full">
                                <label for="inputDeducible">Deducible</label>
                                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                    <input type="text" name="inputDeducible" wire:model="inputDeducible" value="{{$inputDeducible}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                                    @error('inputDeducible')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        </tbody>
    </table>


<table class="items-center w-full mb-0 align-top border-gray-200 border-2">
    <tbody>
        <tr>
            <td style="width: 60%">
                <div class="frameCliente">
                    <div class="p-2 w-full">
                        <label for="inputNombreCliente">Cliente</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputNombreCliente" wire:model="inputNombreCliente" value="{{$inputNombreCliente}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputNombreCliente')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputTelefonos">Fono(s)</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputTelefonos" wire:model="inputTelefonos" value="{{$inputTelefonos}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputTelefonos')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputRecepcion">Recepción</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputRecepcion" wire:model="inputRecepcion" value="{{$inputRecepcion}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputRecepcion')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputMarca">Marca</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputMarca" wire:model="inputMarca" value="{{$inputMarca}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputMarca')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputModelo">Modelo</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputModelo" wire:model="inputModelo" value="{{$inputModelo}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputModelo')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputColor">Color</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputColor" wire:model="inputColor" value="{{$inputColor}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputColor')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                </div>

            </td>
            <td style="width: 40%">
                <div class="frameValores">
                    <div class="p-2 w-full">
                        <label for="inputValorDesabollador">Valor total Neto</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputValorDesabollador" wire:model="inputValorDesabollador" value="{{$inputValorDesabollador}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputValorDesabollador')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputHrsDesabolladura">Hrs/Desabolladura</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputHrsDesabolladura" wire:model="inputHrsDesabolladura" value="{{$inputHrsDesabolladura}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputHrsDesabolladura')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputValorPlastico">Plástico</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputValorPlastico" wire:model="inputValorPlastico" value="{{$inputValorPlastico}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"  required/>
                            @error('inputValorPlastico')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputValorPreparado">Preparado</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputValorPreparado" wire:model="inputValorPreparado" value="{{$inputValorPreparado}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputValorPreparado')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputValorPintura">Pintura</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputValorPintura" wire:model="inputValorPintura" value="{{$inputValorPintura}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                            @error('inputValorPintura')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <label for="inputValorPulido">Pulido</label>
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <input type="text" name="inputValorPulido" wire:model="inputValorPulido" value="{{$inputValorPulido}}" class="pl-2 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>

                            @error('inputValorPulido')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
                        </div>
                    </div>
                </div>

            </td>
        </tr>
    </tbody>
</table>


        <div class="FrameTabla">
            <table class="items-center w-full mb-0 align-top border-gray-200 border-2">
                <thead class="align-bottom">
                <tr>
                    <th style="color:red; width: 60px;" class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none  text-slate-400 opacity-70">
                        Daño
                    </th>
                    <th style="width: 70%;" class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        Descripción
                    </th>
                    <th style="width: 60px;" class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        Pintura
                    </th>
                    <th style="width: 10%;" class="printHide px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        Acción
                    </th>
                </tr>
                </thead>
                <tbody >
                @foreach($detalleOrden as $orden)
                    <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <input type="hidden" name="id" value="{{$orden->ID}}">
                            <input type="text" name="inputDanio{{$orden->ID}}" value="{{$orden->Danio}}" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <input type="text" name="inputDescripcion{{$orden->ID}}" value="{{$orden->Descripcion}}" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                        </td>
                        {{--<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <input type="text" name="inputDesMontar{{$orden->ID}}" value="{{$orden->DesMontar}}" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <input type="text" name="inputMecanica{{$orden->ID}}" value="{{$orden->Mecanica}}" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                        </td>--}}
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <input type="text" name="inputValorPintura{{$orden->ID}}" value="{{$orden->Pintura}}" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                        </td>
                        {{--<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <input type="text" name="inputValorRepuesto{{$orden->ID}}" value="{{$orden->Repuestos}}" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                        </td>--}}
                        <td class="printHide">
                          <div>
                            <button type="button" wire:click="eliminarDetalleOrden({{$orden->ID}})"
                                 style="background-color: #ef4444"   class="mr-3 inline-block px-4 py-1.5 font-bold text-center bg-red-700 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white">Quitar</button>
                          </div>
                        </td>
                    </tr>
                @endforeach

                <tr class="printHide">
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <input type="text" name="inputDanioNew" wire:model="inputDanioNew" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <input type="text" name="inputDescripcionNew" wire:model="inputDescripcionNew" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                    </td>
                    {{--<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <input type="text" name="inputDesMontarNew" wire:model="inputDesMontarNew" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <input type="text" name="inputMecanicaNew" wire:model="inputMecanicaNew" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                    </td>--}}
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <input type="text" name="inputValorPinturaNew" wire:model="inputValorPinturaNew" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                    </td>
                    {{--<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <input type="text" name="inputValorRepuestoNew" wire:model="inputValorRepuestoNew" class="pl-2 text-xs focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" required/>
                    </td>--}}
                    <td class="printHide">
                        <div>
                        <button type="button" wire:click="agregarDetalleOrden"
                          style="background-color: #22c55e"   class="mr-3 inline-block px-4 py-1.5 font-bold text-center bg-green-500 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white">Agregar</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <br>
            <div style="font-size: 10px;">
                <p>C: Cambio  - P: Pintura - M: Mecánica - O: Otros</p>
                <p>R: Reparar  - D/M: Desmontar y Montar </p>
            </div>
            <div style="text-align: center">
                <p>Evaluador: {{@$evaluador->Nombre}}</p>
                <div class="inline-block">
                    <img src="{{asset('assets/img/logo_kia.png')}}" style="margin-left: 10px;" width="80px">
                </div>
                <div class="inline-block">
                    <img src="{{asset('assets/img/logo_subaru.png')}}" style="margin-left: 10px;" width="80px">
                </div>
                <div class="inline-block">
                    <img src="{{asset('assets/img/logo_geely.png')}}" style="margin-left: 10px;" width="80px">
                </div>
                <div class="inline-block">
                    <img src="{{asset('assets/img/logo_dfsk.png')}}" style="margin-left: 10px;" width="80px">
                </div>
            </div>
        </div>
    </div>

