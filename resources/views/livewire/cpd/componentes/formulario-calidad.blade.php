 <form wire:submit.prevent="save" id="formCalidad" class="w-full ">
    <style>
        table, tr, td{
            border: 1px solid #575757;
            border-collapse: collapse;
            padding: 5px;
        }

        input[type="text"]
        {
            padding: 0px !important;
            border: none;
            background-color: transparent;
            width: 100%;
            margin: 0;
            text-align: left;
            font-size: 0.65rem !important;
            height: 16px !important;
        }

        [type="checkbox"]:indeterminate {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 16 16'%3e%3cpath stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8h8'/%3e%3c/svg%3e");
            background-color: red;
        }

        input[type="datetime-local"]
        {
            padding: 0px !important;
            border: none;
            background-color: transparent;
            width: 100%;
            margin: 0;
            text-align: left;
            font-size: 0.65rem !important;
            height: 16px !important;
        }

        input[type="number"]
        {
            padding: 0px !important;
            border: none;
            background-color: transparent;
            width: 100%;
            margin: 0;
            text-align: left;
            font-size: 0.65rem !important;
            height: 16px !important;
        }


        @media print {
            table, tr, td{
                border: 2px solid #575757;
                border-collapse: collapse;
                padding: 5px;
            }

            #formInspeccion{
                width: 100%;
                margin: 5px;
                padding: 10px;
            }

            li {
                list-style:none; font-size:12px;
            }

            [type="checkbox"]:indeterminate {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 16 16'%3e%3cpath stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8h8'/%3e%3c/svg%3e");
                background-color: red !important;
            }

            [type="checkbox"]:checked {
                background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
            }
        }
    </style>


    <div id="OrdenFrame shadow-2xl w-full">

        <table class="w-full text-center text-size-xxs p-2">
            <tr>
                <td colspan="2" class="w-1/3 p-1">
                    <img src="{{asset('assets/img/pompeyologo.png')}}" style="margin-left: 10px;" width="200px">
                </td>
                <td colspan="2" class="w-1/3 text-size-xxs font-bold  p-1">
                    Control de calidad
                    <br> Fecha 11/08/2023 09:36</td>
                <td colspan="2" class="w-1/3 p-1">
                    &nbsp;
                </td>
            </tr>
        </table>


        <table class="w-full text-left text-size-xxs p-2">
            <thead>
            <tr>
                <th colspan="2" class="font-bold">Información Principal</th>
                <th colspan="2" class="font-bold">Documentos</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td rowspan="3">
                    <ul class="font-bold">
                        <li>Patente:</li>
                        <li>Tipo Carrocería:</li>
                        <li>Segmento:</li>
                        <li>Marca:</li>
                        <li>Modelo:</li>
                        <li>Versión:</li>
                        <li>Año:</li>
                        <li>VIN:</li>
                        <li>Puertas:</li>
                        <li>Color exterior:</li>
                        <li>Color interior:</li>
                        <li>Tapiz:</li>
                        <li>Techo:</li>
                        <li>Tracción:</li>
                    </ul>
                </td>
                <td rowspan="3">
                    <ul>
                        <li><input type="text" wire:model.debounce.500ms="inputPatente"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputTipoCarrocería"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputSegmento"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputMarca"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputModelo"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputVersión"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputAnio"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputVIN"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputPuertas"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputColorexterior"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputColorinterior"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputTapiz"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputTecho"> </li>
                        <li><input type="text" wire:model.debounce.500ms="inputTracción"> </li>
                    </ul>
                </td>
                <td>
                    <ul class="font-bold">
                        <li>Permiso de circulación:</li>
                        <li>Revisión Técnica:</li>
                        <li>SOAP:</li>
                        <li>Cantidad de dueños:</li>
                        <li>Multas:</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><input type="datetime-local" wire:model.debounce.500ms="inputFechaPermiso"></li>
                        <li><input type="datetime-local" wire:model.debounce.500ms="inputFechaRevision"></li>
                        <li><input type="datetime-local" wire:model.debounce.500ms="inputFechaSoap"></li>
                        <li><input type="number" wire:model.debounce.500ms="inputCantidadDuenios"></li>
                        <li><input type="number" wire:model.debounce.500ms="inputMultas"></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="font-bold">Motor</td>
            </tr>
            <tr>
                <td>
                    <ul class="font-bold">
                        <li>Combustible:</li>
                        <li>Transmisión:</li>
                        <li>Dirección:</li>
                        <li>Última mantención:</li>
                        <li>Cilindrada:</li>
                        <li>Motor:</li>
                        <li>KM:</li>
                    </ul>
                </td>
                <td>
                    <ul >
                        <li><input type="text" wire:model.debounce.500ms="inputCombustible"></li>
                        <li><input type="text" wire:model.debounce.500ms="inputTransmisión"></li>
                        <li><input type="text" wire:model.debounce.500ms="inputDirección"></li>
                        <li><input type="datetime-local" wire:model.debounce.500ms="inputÚltimaMantención"></li>
                        <li><input type="text" wire:model.debounce.500ms="inputCilindrada"></li>
                        <li><input type="text" wire:model.debounce.500ms="inputMotor"></li>
                        <li><input type="text" wire:model.debounce.500ms="inputKM"></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="font-bold text-center">Equipamiento General</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ul>
                        <li><input data-checked="{{$inputAireAcondicionado}}" wire:model.debounce.500ms="inputAireAcondicionado" type="checkbox"> Aire Acondicionado</li>
                        <li><input data-checked="{{$inputClimatizador}}" wire:model.debounce.500ms="inputClimatizador" type="checkbox"> Climatizador</li>
                        <li><input data-checked="{{$inputAlzavidriosDelantero}}" wire:model.debounce.500ms="inputAlzavidriosDelantero" type="checkbox"> Alzavidrios Eléctricos Delantero</li>
                        <li><input data-checked="{{$inputAlzavidriosTrasero}}" wire:model.debounce.500ms="inputAlzavidriosTrasero" type="checkbox"> Alzavidrios Eléctricos Trasero</li>
                        <li><input data-checked="{{$inputRadioVolante}}" wire:model.debounce.500ms="inputRadioVolante" type="checkbox"> Radio Con Control Al Volante</li>
                        <li><input data-checked="{{$inputRadioDvd}}" wire:model.debounce.500ms="inputRadioDvd" type="checkbox"> Radio Dvd</li>
                        <li><input data-checked="{{$inputBluetooth}}" wire:model.debounce.500ms="inputBluetooth" type="checkbox"> Bluetooth</li>
                        <li><input data-checked="{{$inputVolanteRegulable}}" wire:model.debounce.500ms="inputVolanteRegulable" type="checkbox"> Volante Regulable</li>
                        <li><input data-checked="{{$inputVolanteCuero}}" wire:model.debounce.500ms="inputVolanteCuero" type="checkbox"> Volante Tapiz Cuero</li>
                        <li><input data-checked="{{$inputVelocidadCrucero}}" wire:model.debounce.500ms="inputVelocidadCrucero" type="checkbox"> Velocidad Crucero Computador A Bordo</li>
                    </ul>
                </td>
                <td colspan="2">
                    <ul>
                        <li><input data-checked="{{$inputAndroidCarPlay}}" wire:model.debounce.500ms="inputAndroidCarPlay" type="checkbox">  Android CarPlay</li>
                        <li><input data-checked="{{$inputEspejosExteriores}}" wire:model.debounce.500ms="inputEspejosExteriores" type="checkbox">  Espejos Exteriores Eléctricos</li>
                        <li><input data-checked="{{$inputEspejosRetractiles}}" wire:model.debounce.500ms="inputEspejosRetractiles" type="checkbox">  Espejos Retractiles</li>
                        <li><input data-checked="{{$inputAsientosElectricos}}" wire:model.debounce.500ms="inputAsientosElectricos" type="checkbox">  Asientos Eléctricos</li>
                        <li><input data-checked="{{$inputAsientosCalefaccionados}}" wire:model.debounce.500ms="inputAsientosCalefaccionados" type="checkbox">  Asientos Calefaccionados</li>
                        <li><input data-checked="{{$inputAsientoTraseroAbatible}}" wire:model.debounce.500ms="inputAsientoTraseroAbatible" type="checkbox">  Asiento Trasero Abatible</li>
                        <li><input data-checked="{{$inputAperturaMaletaInterior}}" wire:model.debounce.500ms="inputAperturaMaletaInterior" type="checkbox">  Apertura De Maleta Desde El Interior</li>
                        <li><input data-checked="{{$inputTerceraCorrida}}" wire:model.debounce.500ms="inputTerceraCorrida" type="checkbox">  Tercera Corrida</li>
                        <li><input data-checked="{{$inputAsientosTermorregulables}}" wire:model.debounce.500ms="inputAsientosTermorregulables" type="checkbox">  Asientos Termorregulables</li>
                        <li><input data-checked="{{$inputPartidaBotón}}" wire:model.debounce.500ms="inputPartidaBotón" type="checkbox">  Partida Botón Start Stop</li>
                    </ul>
                </td>
            </tr>

            <tr>
                <td colspan="4" class="font-bold text-center">Equipamiento de Seguridad</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ul>
                        <li><input data-checked="{{$inputAlarma}}" wire:model.debounce.500ms="inputAlarma" type="checkbox"> Alarma</li>
                        <li><input data-checked="{{$inputSeguimientoGps}}" wire:model.debounce.500ms="inputSeguimientoGps" type="checkbox"> Seguimiento Gps</li>
                        <li><input data-checked="{{$inputKeyless}}" wire:model.debounce.500ms="inputKeyless" type="checkbox"> Keyless</li>
                        <li><input data-checked="{{$inputLlaveCodificada}}" wire:model.debounce.500ms="inputLlaveCodificada" type="checkbox"> Llave Codificada</li>
                        <li><input data-checked="{{$inputCierreCentralizado}}" wire:model.debounce.500ms="inputCierreCentralizado" type="checkbox"> Cierre Centralizado</li>
                        <li><input data-checked="{{$inputAirgagConductor}}" wire:model.debounce.500ms="inputAirgagConductor" type="checkbox"> Airgag Conductor</li>
                        <li><input data-checked="{{$inputAirgagAcompañante}}" wire:model.debounce.500ms="inputAirgagAcompañante" type="checkbox"> Airgag Acompañante</li>
                        <li><input data-checked="{{$inputAirgagLateralDelantero}}" wire:model.debounce.500ms="inputAirgagLateralDelantero" type="checkbox"> Airgag Lateral Delantero</li>
                        <li><input data-checked="{{$inputAirgagLateralTrasero}}" wire:model.debounce.500ms="inputAirgagLateralTrasero" type="checkbox"> Airgag Lateral Trasero</li>
                        <li><input data-checked="{{$inputAirgagAdicionales}}" wire:model.debounce.500ms="inputAirgagAdicionales" type="checkbox"> Airgag Adicionales</li>
                        <li><input data-checked="{{$inputFrenosDisco}}" wire:model.debounce.500ms="inputFrenosDisco" type="checkbox"> Frenos De Discos Traseros</li>
                        <li><input data-checked="{{$inputFrenosAbs}}" wire:model.debounce.500ms="inputFrenosAbs" type="checkbox"> Frenos Abs</li>
                    </ul>
                </td>
                <td colspan="2">
                    <ul>
                        <li><input data-checked="{{$inputEsp}}" wire:model.debounce.500ms="inputEsp" type="checkbox"> ESP (Control electrónico de estabilidad)</li>
                        <li><input data-checked="{{$inputControlTraccion}}" wire:model.debounce.500ms="inputControlTraccion" type="checkbox"> Control De Tracción</li>
                        <li><input data-checked="{{$inputIsofix}}" wire:model.debounce.500ms="inputIsofix" type="checkbox"> Isofix</li>
                        <li><input data-checked="{{$inputSensorRetroceso}}" wire:model.debounce.500ms="inputSensorRetroceso" type="checkbox"> Sensor De Retroceso</li>
                        <li><input data-checked="{{$inputCamaraRetroceso}}" wire:model.debounce.500ms="inputCamaraRetroceso" type="checkbox"> Cámara Retroceso </li>
                        <li><input data-checked="{{$inputCámara360}}" wire:model.debounce.500ms="inputCámara360" type="checkbox"> Cámara 360</li>
                        <li><input data-checked="{{$inputSensorLluvia}}" wire:model.debounce.500ms="inputSensorLluvia" type="checkbox"> Sensor De Lluvia</li>
                        <li><input data-checked="{{$inputSensorLucesAltas}}" wire:model.debounce.500ms="inputSensorLucesAltas" type="checkbox"> Sensor De Luces Altas</li>
                        <li><input data-checked="{{$inputSensorCambioPista}}" wire:model.debounce.500ms="inputSensorCambioPista" type="checkbox"> Sensor Cambio De Pista</li>
                        <li><input data-checked="{{$inputAsistenciaEstacionar}}" wire:model.debounce.500ms="inputAsistenciaEstacionar" type="checkbox"> Asistencia Para Estacionar</li>
                        <li><input data-checked="{{$inputAsistenciaManejo}}" wire:model.debounce.500ms="inputAsistenciaManejo" type="checkbox"> Asistencia Durante Manejo</li>
                        <li><input data-checked="{{$inputAsistenciaFrenado}}" wire:model.debounce.500ms="inputAsistenciaFrenado" type="checkbox"> Asistencia De Frenado</li>
                        <li><input data-checked="{{$inputVelocidadCruceroAdaptativa}}" wire:model.debounce.500ms="inputVelocidadCruceroAdaptativa" type="checkbox"> Velocidad Crucero Adaptativa</li>
                    </ul>
                </td>
            </tr>


            <tr>
                <td colspan="4" class="font-bold text-center">Accesorios</td>
            </tr>
            <tr>
                <td colspan="4">
                    <ul>
                        <li><input wire:model.debounce.500ms="inputLlantasAleación" type="checkbox"> Llantas De Aleación</li>
                        <li><input wire:model.debounce.500ms="inputNeblinerosDelanteros" type="checkbox"> Neblineros Delanteros</li>
                        <li><input wire:model.debounce.500ms="inputVidriosPolarizados" type="checkbox"> Vidrios Polarizados</li>
                        <li><input wire:model.debounce.500ms="inputFocosLed" type="checkbox"> Focos Led</li>
                        <li><input wire:model.debounce.500ms="inputSpoiler" type="checkbox"> Spoiler</li>
                        <li><input wire:model.debounce.500ms="inputBodyKit" type="checkbox"> Body Kit</li>
                        <li><input wire:model.debounce.500ms="inputPisaderas" type="checkbox"> Pisaderas</li>
                    </ul>
                </td>

            </tr>
            </tbody>
        </table>

        <button type="submit" class="mr-3 inline-block px-4 py-1.5 font-bold text-center bg-gradient-to-tl from-blue-500 to-violet-500 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white">Guardar</button>
        <a href="javascript:imprSelec('formCalidad')" class="mr-3 inline-block px-4 py-1.5 font-bold text-center bg-gradient-to-tl from-blue-500 to-violet-500 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white">
            Imprimir
        </a>

    </div>
 </form>
<script>
    var $check = $("input[type=checkbox]");


    $("input[type=checkbox]").each(function(){
        var el = $(this);
        switch (el.data('checked')) {

            case 1:
                el.data('checked', 1);
                $(this).val(1) ;
                el.prop('indeterminate', true);
                console.log('null');
                break;

            case 2:
                el.data('checked', 2);
                $(this).val(2);
                el.prop('indeterminate', false);
                el.prop('checked', true);
                console.log('true');
                break;

            default:
                el.data('checked', 0);
                $(this).val(0);
                el.prop('indeterminate', false);
                el.prop('checked', false);
                console.log('false');
        }
    })

    $check.data('checked', 0).on('click', function() {

        var el = $(this);

        switch (el.data('checked')) {

            case 0:
                el.data('checked', 1);
                $(this).val(1) ;
                el.prop('indeterminate', true);
                console.log('null');
                break;

            case 1:
                el.data('checked', 2);
                $(this).val(2);
                el.prop('indeterminate', false);
                el.prop('checked', true);
                console.log('true');
                break;

            default:
                el.data('checked', 0);
                $(this).val(0);
                el.prop('indeterminate', false);
                el.prop('checked', false);
                console.log('false');
        }
    });
</script>
