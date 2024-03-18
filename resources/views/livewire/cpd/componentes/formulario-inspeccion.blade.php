<form class="" id="formInspeccion" wire:submit.prevent="save">
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

    [type="checkbox"]:indeterminate {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 16 16'%3e%3cpath stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8h8'/%3e%3c/svg%3e");
        background-color: red;
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
    }
</style>
<div id="OrdenFrame shadow-2xl w-full">
    <table class="w-full text-center text-size-xxs p-2">
        <tr>
            <td colspan="2" class="w-1/3 p-1">
                <img src="{{asset('assets/img/pompeyologo.png')}}" style="margin-left: 10px;" width="200px">
            </td>
            <td colspan="2" class="w-1/3 text-size-xxs font-bold  p-1">
                Peritaje {{$cpd->Version}} PATENTE: {{$cpd->Patente}}
               <br> Fecha {{date('Y-m-d H:i')}}</td>
            <td colspan="2" class="w-1/3 p-1">
                <br>Sucursal: {{$cpd->Sucursal->Sucursal}}
                <br>Cliente: {{$cpd->ClienteNombre}} {{$cpd->ClienteApellido}}
                <br>Vendedor: {{@$cpd->Vendedor->Nombre}}
            </td>
        </tr>

        <tr>
            <td colspan="6" class="font-bold">Datos del vehículo</td>
        </tr>
        <tr class="text-left border-2">
            <td class="font-bold w-1/6">Versión:</td>
            <td class="w-1/6"><input type="text" wire:model.debounce.500ms="input.Version"></td>
            <td class="font-bold w-1/6">KILOMETRAJE:</td>
            <td class="w-1/6"><input type="text" wire:model.debounce.500ms="input.Kilometraje"></td>
            <td class="font-bold w-1/6">CILINDRADA:</td>
            <td class="w-1/6"><input type="text" wire:model.debounce.500ms="input.Cilindrada"></td>
        </tr>
        <tr class="text-left border-2">
            <td class="font-bold w-1/6">Número de chasís:</td>
            <td class="w-1/6"><input type="text" wire:model.debounce.500ms="input.NumeroChasis"></td>
            <td class="font-bold w-1/6">TRACCIÓN:</td>
            <td class="w-1/6"><input type="text" wire:model.debounce.500ms="input.Traccion"></td>
            <td class="font-bold w-1/6">COLOR:</td>
            <td class="w-1/6"><input type="text" wire:model.debounce.500ms="input.Color"></td>
        </tr>
        <tr class="text-left border-2">
            <td class="font-bold w-1/6">Año:</td>
            <td class="w-1/6"><input type="text" wire:model.debounce.500ms="input.Anio"></td>
            <td class="font-bold w-1/6">Gasolina:</td>
            <td class="w-1/6"><input type="text" wire:model.debounce.500ms="input.Gasolina"></td>
            <td class="font-bold w-1/6"></td>
            <td class="w-1/6"></td>
        </tr>
    </table>

    <table class="w-full text-center text-size-xxs p-2">
        <tr>
            <td colspan="8" class="font-bold">Documentación</td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Padrón:</td>
            <td class="w-1/8"><input type="text" wire:model.debounce.500ms="input.Padron"></td>
            <td class="font-bold w-1/8">Permiso de circulación:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.PermisoCirculacion" name="PermisoCirculacion" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Revisión Técnica al día:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.RevisionTecnica" name="RevisionTecnica" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Seguro obligatorio:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.SeguroObligatorio" name="SeguroObligatorio" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Número de motor:</td>
            <td class="w-1/8"><input type="text" wire:model.debounce.500ms="input.Motor"></td>
            <td class="font-bold w-1/8">Próximo Permiso de circulación:</td>
            <td class="w-1/8"><input type="datetime-local" wire:model.debounce.500ms="input.PermisoCirculacion"></td>
            <td class="font-bold w-1/8">Próxima revisión técnica:</td>
            <td class="w-1/8"><input type="datetime-local" wire:model.debounce.500ms="input.ProximaRevision"></td>
            <td class="font-bold w-1/8">Próximo seguro obligatorio</td>
            <td class="w-1/8"><input type="datetime-local" wire:model.debounce.500ms="input.ProximoSeguro"></td>
        </tr>
        <tr>
            <td colspan="8" class="font-bold">Accesorios y equipamientos</td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Funcionamiento AA:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.FuncionamientoAire" name="FuncionamientoAire" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Techo Panorámico:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.TechoPanoramico" name="TechoPanoramico" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Control de Estabilidad:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.ControlEstabilidad" name="ControlEstabilidad" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Gata hidráulica:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.GataHidraulica" name="GataHidraulica" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Frenos ABS:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.FrenosABS" name="FrenosABS" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Velocidad Crucero:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.VelocidadCrucero" name="VelocidadCrucero" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Lámina de Seguridad:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.LaminaSeguridad" name="LaminaSeguridad" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Gata tijera: </td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.GataTijera" name="GataTijera" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Airbags:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Airbags" name="Airbags" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Gps:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Gps" name="FuncionamientoAire" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Sensor de Lluvia:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.SensorLluvia" name="SensorLluvia" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Llave rueda:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.LlaveRueda" name="LlaveRueda" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Cierre Centralizado:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.CierreCentralizado" name="CierreCentralizado" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Bluetooth:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Bluetooth" name="Bluetooth" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Tiro de Arrastre:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.TiroArrastre" name="TiroArrastre" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Extintor:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Extintor" name="Extintor" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Llantas:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Llantas" name="Llantas" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Sensor de Retroceso:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.SensorRetroceso" name="SensorRetroceso" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Volante Ajustable:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.VolanteAjustable" name="VolanteAjustable" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Triángulo:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Triangulo" name="Triangulo" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Neblineros:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Neblineros" name="Neblineros" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Paddle Shift:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.PaddleShift" name="PaddleShift" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Asiento con memoria:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.AientoMemoria" name="AientoMemoria" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Botiquín:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Botiquin" name="Botiquin" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Espejos Eléctricos:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.EspejosElectricos" name="EspejosElectricos" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Asientos Eléctricos:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.AsientosElectricos" name="AsientosElectricos" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Tapiz de Cuero:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.TapizCuero" name="TapizCuero" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Chaleco reflectante:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.ChalecoReflectante" name="ChalecoReflectante" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Alza Vidrios Eléctricos:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.AlzaVidriosElectrico" name="AlzaVidriosElectrico" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Radio original:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.RadioOriginal" name="RadioOriginal" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Cuero:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Cuero" name="Cuero" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Libro de mantenciones:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.LibroMantenciones" name="LibroMantenciones" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Dirección:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Direccion" name="Direccion" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Segunda copia llave:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.SegundaCopiaLlave" name="SegundaCopiaLlave" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Transmisión:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Transmision" name="Transmision" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Rueda de Repuesto:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.RuedaRepuesto" name="RuedaRepuesto" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Techo Corredizo:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.TechoCorredizo" name="TechoCorredizo" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Anclaje Isofix:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.AnclajeIsofix" name="AnclajeIsofix" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Tracción:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Traccion" name="Traccion" :options="$options" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8"></td>
            <td class="w-1/8"></td>
        </tr>

        <tr>
            <td colspan="8" class="font-bold">Vista Interna</td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Tapiz:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Tapiz" name="Tapiz" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Piso:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Piso" name="Piso" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Manubrio:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Manubrio" name="Manubrio" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Puertas</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Puertas" name="Puertas" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr class="text-left">
            <td class="font-bold w-1/8">Botoneras:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Botoneras" name="Botoneras" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Maletero:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Maletero" name="Maletero" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8">Techo:</td>
            <td class="w-1/8">
                <x-simple-select wire:model="input.Techo" name="Techo" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold w-1/8"></td>
            <td class="w-1/8"></td>
        </tr>
    </table>


    <table class="w-full text-left text-size-xxs p-2">
        <tr class="text-center">
            <td colspan="8" class="font-bold">Detalles Técnicos</td>
        </tr>
        <tr>
            <td class="font-bold">Neumático</td>
            <td class="">
                <x-simple-select wire:model="input.Neumatico" name="Neumatico" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Dirección</td>
            <td class="">
                <x-simple-select wire:model="input.DetalleDireccion" name="DetalleDireccion" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Tableros instr</td>
            <td class="">
                <x-simple-select wire:model="input.TableroInstrumento" name="TableroInstrumento" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">4x4</td>
            <td class="">
                <x-simple-select wire:model="input.4x4" name="4x4" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr>
            <td class="font-bold">Pérdidas de Agua</td>
            <td class="">
                <x-simple-select wire:model="input.PerdidaAgua" name="PerdidaAgua" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Embrague</td>
            <td class="">
                <x-simple-select wire:model="input.Embrague" name="Embrague" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Anclaje del cinturón</td>
            <td class="">
                <x-simple-select wire:model="input.AnclajeCinturon" name="sel   ectAnclajeCinturon" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Motor</td>
            <td class="">
                <x-simple-select wire:model="input.EstadoMotor" name="EstadoMotor" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr>
            <td class="font-bold">Alineación/Susp</td>
            <td class="">
                <x-simple-select wire:model="input.Alineacion" name="Alineacion" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Calefacción</td>
            <td class="">
                <x-simple-select wire:model="input.Calefaccion" name="Calefaccion" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Frenos (abs)</td>
            <td class="">
                <x-simple-select wire:model="input.Frenos" name="Frenos" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Pérdidas de Aceite</td>
            <td class="">
                <x-simple-select wire:model="input.PerdidaAceite" name="PerdidaAceite" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr>
            <td class="font-bold">Parabrisas</td>
            <td class="">
                <x-simple-select wire:model="input.Parabrisas" name="Parabrisas" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Caja y Diferencial</td>
            <td class="">
                <x-simple-select wire:model="input.CajaDiferencial" name="CajaDiferencial" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Luces</td>
            <td class="">
                <x-simple-select wire:model="input.Luces" name="Luces" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">L.Parabrisas del./tras</td>
            <td class="">
                <x-simple-select wire:model="selecParabrisas" name="selecParabrisas" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr>
            <td class="font-bold">Correas</td>
            <td class="">
                <x-simple-select wire:model="input.Correas" name="Correas" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Mangueras</td>
            <td class="">
                <x-simple-select wire:model="input.Mangueras" name="Mangueras" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold">Bocina</td>
            <td class="">
                <x-simple-select wire:model="input.Bocina" name="Bocina" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
            <td class="font-bold"></td>
            <td class=""></td>
        </tr>
    </table>

    <table class="w-full text-left text-size-xxs p-2">
        <tr class="text-center">
            <td colspan="4" class="font-bold">Vehículos híbridos/eléctricos</td>
        </tr>
        <tr>
            <td class="font-bold ">PORCENTAJE RESTANTE DE LA BATERÍA:</td>
            <td class=""><input type="number" wire:model.debounce.500ms="input.PorcenjateBateria" name="PorcenjateBateria" class="w-1/2 text-xs input-sm"> %</td>
            <td class="font-bold">VIDA ÚTIL DE LA BATERÍA:</td>
            <td class="">
                <x-simple-select wire:model="selecVidaBateria" name="selecVidaBateria" :options="$options2" value-field='dato' text-field='dato' placeholder=""/>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="font-bold w-1/2">Comentario documentación:</td>
            <td colspan="2" class="font-bold w-1/2">Comentario detalles técnicos:</td>
        </tr>
        <tr>
            <td colspan="2" class="">
                <textarea  wire:model.debounce.500ms="input.ComentarioDocumentacion" name="ComentarioDocumentacion" class="w-full"></textarea>
            </td>
            <td colspan="2" class="">
                <textarea  wire:model.debounce.500ms="input.ComentarioDetallesTecnicos" name="ComentarioDetallesTecnicos" class="w-full"></textarea>
            </td>
        </tr>

    </table>


    <livewire:cpd.componentes.create.detalle-inspeccion : idCpd="{{$idCpd}}"/>


    <div class="text-right"><small>Costo total de reparación de vehículo: $0</small></div>


    <div class="setImagenes">
        <table class="tablaSet w-full text-center text-size-xxs p-2">
            <tr>
                <td colspan="4" class="font-bold">Set Imágenes</td>
            </tr>
            <tr>

                <td>
                    <input id="ImagenFrontal" name="ImagenFrontal"  type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                    <img src="{{asset('assets/img/vehiculos/2.jpg')}}" alt="">
                    Frontal
                </td>
                <td>
                    <input id="fileImagenInterna" name="fileImagenInterna"  type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                    <img src="{{asset('assets/img/vehiculos/3.jpg')}}" alt="">
                    Costado derecho
                </td>
                <td>
                    <input id="fileImagenInterna" name="fileImagenInterna"  type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                    <img src="{{asset('assets/img/vehiculos/4.jpg')}}" alt="">
                    Vista trasera
                </td>
                <td>
                    <input id="fileImagenInterna" name="fileImagenInterna"  type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                    <img src="{{asset('assets/img/vehiculos/5.jpg')}}" alt="">
                    Costado izquierdo
                </td>
            </tr>
            <tr>

                <td>
                    <input id="fileImagenInterna" name="fileImagenInterna"  type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                    <img src="{{asset('assets/img/vehiculos/1.jpg')}}" alt="">
                    Interna
                </td>
                <td>
                    <input id="fileImagenInterna" name="fileImagenInterna"  type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                    <img src="{{asset('assets/img/vehiculos/6.jpg')}}" alt="">
                    Interna
                </td>
                <td>
                    <input id="fileImagenInterna" name="fileImagenInterna"  type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                    <img src="{{asset('assets/img/vehiculos/7.jpg')}}" alt="">
                    Adicional
                </td>
                <td>
                    <input id="fileImagenInterna" name="fileImagenInterna"  type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                    <img src="{{asset('assets/img/vehiculos/8.jpg')}}" alt="">
                    Adicional
                </td>
            </tr>
        </table>

        <button type="submit" class="mr-3 inline-block px-4 py-1.5 font-bold text-center bg-gradient-to-tl from-blue-500 to-violet-500 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white">Guardar</button>
        <a href="javascript:imprSelec('formInspeccion')" class="mr-3 inline-block px-4 py-1.5 font-bold text-center bg-gradient-to-tl from-blue-500 to-violet-500 uppercase align-middle transition-all rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white">
            Imprimir
        </a>
    </div>
</div>

</form>
