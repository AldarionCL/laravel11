<?php

namespace App\Http\Livewire\Cpd\Componentes;

use App\Models\Cpd\CpdCalidad;
use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdTareas;
use Livewire\Component;

class FormularioCalidad extends Component
{

    public $idCpd;
    public $idTarea;
    public $tareas;
    public $cpd;
    public $inputPatente;
    public $inputTipoCarrocería;
    public $inputSegmento;
    public $inputMarca;
    public $inputModelo;
    public $inputVersión;
    public $inputAnio;
    public $inputVIN;
    public $inputPuertas;
    public $inputColorexterior;
    public $inputColorinterior;
    public $inputTapiz;
    public $inputTecho;
    public $inputTracción;
    public $inputFechaPermiso;
    public $inputFechaRevision;
    public $inputFechaSoap;
    public $inputCantidadDuenios;
    public $inputMultas;
    public $inputCombustible;
    public $inputTransmisión;
    public $inputDirección;
    public $inputÚltimaMantención;
    public $inputCilindrada;
    public $inputMotor;
    public $inputKM;

    public $inputAireAcondicionado = false;
    public $inputClimatizador = false;
    public $inputAlzavidriosDelantero = false;
    public $inputAlzavidriosTrasero = false;
    public $inputRadioVolante = false;
    public $inputRadioDvd = false;
    public $inputBluetooth = false;
    public $inputVolanteRegulable = false;
    public $inputVolanteCuero = false;
    public $inputVelocidadCrucero = false;
    public $inputAndroidCarPlay = false;
    public $inputEspejosExteriores = false;
    public $inputEspejosRetractiles = false;
    public $inputAsientosElectricos = false;
    public $inputAsientosCalefaccionados = false;
    public $inputAsientoTraseroAbatible = false;
    public $inputAperturaMaletaInterior = false;
    public $inputTerceraCorrida = false;
    public $inputAsientosTermorregulables = false;
    public $inputPartidaBotón = false;
    public $inputAlarma = false;
    public $inputSeguimientoGps = false;
    public $inputKeyless = false;
    public $inputLlaveCodificada = false;
    public $inputCierreCentralizado = false;
    public $inputAirgagConductor = false;
    public $inputAirgagAcompañante = false;
    public $inputAirgagLateralDelantero = false;
    public $inputAirgagLateralTrasero = false;
    public $inputAirgagAdicionales = false;

    public $inputFrenosDisco = false;
    public $inputFrenosAbs = false;
    public $inputEsp = false;
    public $inputControlTraccion = false;
    public $inputIsofix = false;
    public $inputSensorRetroceso = false;
    public $inputCamaraRetroceso = false;
    public $inputCámara360 = false;
    public $inputSensorLluvia = false;
    public $inputSensorLucesAltas = false;
    public $inputSensorCambioPista = false;
    public $inputAsistenciaEstacionar = false;
    public $inputAsistenciaManejo = false;
    public $inputAsistenciaFrenado = false;
    public $inputVelocidadCruceroAdaptativa = false;
    public $inputLlantasAleación = false;
    public $inputNeblinerosDelanteros = false;
    public $inputVidriosPolarizados = false;
    public $inputFocosLed = false;
    public $inputSpoiler = false;
    public $inputBodyKit = false;
    public $inputPisaderas = false;

    public array $options = [['ID'=> '0','VALOR'=>'N/A'],['ID'=> '1','VALOR'=>'Correcto'],['ID'=> '2','VALOR'=>'Con Problema']];


    public function render()
    {
        $this->tareas = CpdTareas::where('CpdID',$this->idTarea)->get();
        $this->cpd = CpdFlujos::find($this->idCpd);
        $cpd = CpdFlujos::find($this->idCpd);



        return view('livewire.cpd.componentes.formulario-calidad');
    }

    public function mount()
    {
        $this->tareas = CpdTareas::where('CpdID',$this->idTarea)->get();
        $this->cpd = CpdFlujos::find($this->idCpd);
        $cpd = CpdFlujos::find($this->idCpd);
        $formCalidad = CpdCalidad::where('idCpd',$this->idCpd)->first();


        $this->inputPatente = $cpd->Patente;
        $this->inputTipoCarrocería = $cpd->TipoCarrocería;
        $this->inputSegmento = $cpd->Segmento;
        $this->inputMarca = $cpd->Marca;
        $this->inputModelo = $cpd->Modelo;
        $this->inputVersión = $cpd->Version;
        $this->inputAnio = $cpd->Anio;
        $this->inputVIN = $cpd->Vin;
        $this->inputPuertas = $cpd->Puertas;
        $this->inputColorexterior = $cpd->ColorExterior;
        $this->inputColorinterior = $cpd->ColorInterior;
        $this->inputTapiz = $cpd->Tapiz;
        $this->inputTecho = $cpd->Techo;
        $this->inputTracción = $cpd->Traccion;

        $this->inputFechaPermiso = $cpd->FechaPermiso;
        $this->inputFechaRevision = $cpd->FechaRevision;
        $this->inputFechaSoap = $cpd->FechaSoap;
        $this->inputCantidadDuenios = $cpd->CantidadDuenios;
        $this->inputMultas = $cpd->Multas;

        $this->inputCombustible = $cpd->Combustible;
        $this->inputTransmisión = $cpd->Transmision;
        $this->inputDirección = $cpd->Dirección;
        $this->inputÚltimaMantención = $cpd->ÚltimaMantención;
        $this->inputCilindrada = $cpd->Cilindrada;
        $this->inputMotor = $cpd->Motor;
        $this->inputKM = $cpd->Kilometraje;


        if($formCalidad){
            $this->inputPatente = $formCalidad->Patente;
            $this->inputTipoCarrocería = $formCalidad->TipoCarrocería;
            $this->inputSegmento = $formCalidad->Segmento;
            $this->inputMarca = $formCalidad->Marca;
            $this->inputModelo = $formCalidad->Modelo;
            $this->inputVersión = $formCalidad->Versión;
            $this->inputAnio = $formCalidad->Anio;
            $this->inputVIN = $formCalidad->VIN;
            $this->inputPuertas = $formCalidad->Puertas;
            $this->inputColorexterior = $formCalidad->Colorexterior;
            $this->inputColorinterior = $formCalidad->Colorinterior;
            $this->inputTapiz = $formCalidad->Tapiz;
            $this->inputTecho = $formCalidad->Techo;
            $this->inputTracción = $formCalidad->Tracción;
            $this->inputFechaPermiso = $formCalidad->FechaPermiso;
            $this->inputFechaRevision = $formCalidad->FechaRevision;
            $this->inputFechaSoap = $formCalidad->FechaSoap;
            $this->inputCantidadDuenios = $formCalidad->CantidadDuenios;
            $this->inputMultas = $formCalidad->Multas;
            $this->inputCombustible = $formCalidad->Combustible;
            $this->inputTransmisión = $formCalidad->Transmisión;
            $this->inputDirección = $formCalidad->Dirección;
            $this->inputÚltimaMantención = $formCalidad->ÚltimaMantención;
            $this->inputCilindrada = $formCalidad->Cilindrada;
            $this->inputMotor = $formCalidad->Motor;
            $this->inputKM = $formCalidad->KM;
            $this->inputAireAcondicionado = $formCalidad->AireAcondicionado;
            $this->inputClimatizador = $formCalidad->Climatizador;
            $this->inputAlzavidriosDelantero = $formCalidad->AlzavidriosDelantero;
            $this->inputAlzavidriosTrasero = $formCalidad->AlzavidriosTrasero;
            $this->inputRadioVolante = $formCalidad->RadioVolante;
            $this->inputRadioDvd = $formCalidad->RadioDvd;
            $this->inputBluetooth = $formCalidad->Bluetooth;
            $this->inputVolanteRegulable = $formCalidad->VolanteRegulable;
            $this->inputVolanteCuero = $formCalidad->VolanteCuero;
            $this->inputVelocidadCrucero = $formCalidad->VelocidadCrucero;
            $this->inputAndroidCarPlay = $formCalidad->AndroidCarPlay;
            $this->inputEspejosExteriores = $formCalidad->EspejosExteriores;
            $this->inputEspejosRetractiles = $formCalidad->EspejosRetractiles;
            $this->inputAsientosElectricos = $formCalidad->AsientosElectricos;
            $this->inputAsientosCalefaccionados = $formCalidad->AsientosCalefaccionados;
            $this->inputAsientoTraseroAbatible = $formCalidad->AsientoTraseroAbatible;
            $this->inputAperturaMaletaInterior = $formCalidad->AperturaMaletaInterior;
            $this->inputTerceraCorrida = $formCalidad->TerceraCorrida;
            $this->inputAsientosTermorregulables = $formCalidad->AsientosTermorregulables;
            $this->inputPartidaBotón = $formCalidad->PartidaBotón;

            $this->inputAlarma = $formCalidad->Alarma;
            $this->inputSeguimientoGps = $formCalidad->SeguimientoGps;
            $this->inputKeyless = $formCalidad->Keyless;
            $this->inputLlaveCodificada = $formCalidad->LlaveCodificada;
            $this->inputCierreCentralizado = $formCalidad->CierreCentralizado;
            $this->inputAirgagConductor = $formCalidad->AirgagConductor;
            $this->inputAirgagAcompañante = $formCalidad->AirgagAcompañante;
            $this->inputAirgagLateralDelantero = $formCalidad->AirgagLateralDelantero;
            $this->inputAirgagLateralTrasero = $formCalidad->AirgagLateralTrasero;
            $this->inputAirgagAdicionales = $formCalidad->AirgagAdicionales;

            $this->inputFrenosDisco = $formCalidad->FrenosDIsco;
            $this->inputFrenosAbs = $formCalidad->FrenosAbs;
            $this->inputEsp = $formCalidad->Esp;
            $this->inputControlTraccion = $formCalidad->ControlTraccion;
            $this->inputIsofix = $formCalidad->IsoFix;
            $this->inputSensorRetroceso = $formCalidad->SensorRetroceso;
            $this->inputCamaraRetroceso = $formCalidad->CamaraRetroceso;
            $this->inputCámara360 = $formCalidad->Cámara360;
            $this->inputSensorLluvia = $formCalidad->SensorLluvia;
            $this->inputSensorLucesAltas = $formCalidad->SensorLucesAltas;
            $this->inputSensorCambioPista = $formCalidad->SensorCambioPista;
            $this->inputAsistenciaEstacionar = $formCalidad->AsistenciaEstacionar;
            $this->inputAsistenciaManejo = $formCalidad->AsistenciaManejo;
            $this->inputAsistenciaFrenado = $formCalidad->AsistenciaFrenado;
            $this->inputVelocidadCruceroAdaptativa = $formCalidad->VelocidadCruceroAdaptativa;
            $this->inputLlantasAleación = $formCalidad->LlantasAleación;
            $this->inputNeblinerosDelanteros = $formCalidad->NeblinerosDelanteros;
            $this->inputVidriosPolarizados = $formCalidad->VidriosPolarizados;
            $this->inputFocosLed = $formCalidad->FocosLed;
            $this->inputSpoiler = $formCalidad->Spoiler;
            $this->inputBodyKit = $formCalidad->BodyKit;
            $this->inputPisaderas = $formCalidad->Pisaderas;
        }else
        {
            $this->inputPatente = $cpd->Patente;
            $this->inputTipoCarrocería = $cpd->TipoCarrocería;
            $this->inputSegmento = $cpd->Segmento;
            $this->inputMarca = $cpd->Marca;
            $this->inputModelo = $cpd->Modelo;
            $this->inputVersión = $cpd->Version;
            $this->inputAnio = $cpd->Anio;
            $this->inputVIN = $cpd->VIN;
            $this->inputPuertas = $cpd->Puertas;
            $this->inputColorexterior = $cpd->ColorExterior;
            $this->inputColorinterior = $cpd->ColorInterior;
            $this->inputTapiz = $cpd->Tapiz;
            $this->inputTecho = $cpd->Techo;
            $this->inputTracción = $cpd->Traccion;

            $this->inputFechaPermiso = $cpd->FechaPermiso;
            $this->inputFechaRevision = $cpd->FechaRevision;
            $this->inputFechaSoap = $cpd->FechaSoap;
            $this->inputCantidadDuenios = $cpd->CantidadDuenios;
            $this->inputMultas = $cpd->Multas;

            $this->inputCombustible = $cpd->Combustible;
            $this->inputTransmisión = $cpd->Transmisión;
            $this->inputDirección = $cpd->Dirección;
            $this->inputÚltimaMantención = $cpd->ÚltimaMantención;
            $this->inputCilindrada = $cpd->Cilindrada;
            $this->inputMotor = $cpd->Motor;
            $this->inputKM = $cpd->KM;
        }


    }

    public function save()
    {
        $formCalidad = CpdCalidad::where('idCpd',$this->idCpd)->first();

        if($formCalidad){
            $calidad = CpdCalidad::find($formCalidad->ID);
        }else
        {
            $calidad = new CpdCalidad();
        }

        $calidad->idCpd = $this->idCpd;
        $calidad->Patente = $this->inputPatente;
        $calidad->TipoCarrocería = $this->inputTipoCarrocería;
        $calidad->Segmento = $this->inputSegmento;
        $calidad->Marca = $this->inputMarca;
        $calidad->Modelo = $this->inputModelo;
        $calidad->Versión = $this->inputVersión;
        $calidad->Anio = $this->inputAnio;
        $calidad->VIN = $this->inputVIN;
        $calidad->Puertas = $this->inputPuertas;
        $calidad->ColorExterior = $this->inputColorexterior;
        $calidad->ColorInterior = $this->inputColorinterior;
        $calidad->Tapiz = $this->inputTapiz;
        $calidad->Techo = $this->inputTecho;
        $calidad->Tracción = $this->inputTracción;
        $calidad->FechaPermiso = $this->inputFechaPermiso;
        $calidad->FechaRevision = $this->inputFechaRevision;
        $calidad->FechaSoap = $this->inputFechaSoap;
        $calidad->CantidadDuenios = $this->inputCantidadDuenios;
        $calidad->Multas = $this->inputMultas;
        $calidad->Combustible = $this->inputCombustible;
        $calidad->Transmisión = $this->inputTransmisión;
        $calidad->Dirección = $this->inputDirección;
        $calidad->ÚltimaMantención = $this->inputÚltimaMantención;
        $calidad->Cilindrada = $this->inputCilindrada;
        $calidad->Motor = $this->inputMotor;
        $calidad->KM = $this->inputKM;
        $calidad->AireAcondicionado  = $this->inputAireAcondicionado;
        $calidad->Climatizador  = $this->inputClimatizador;
        $calidad->AlzavidriosDelantero  = $this->inputAlzavidriosDelantero;
        $calidad->AlzavidriosTrasero  = $this->inputAlzavidriosTrasero;
        $calidad->RadioVolante  = $this->inputRadioVolante;
        $calidad->RadioDvd  = $this->inputRadioDvd;
        $calidad->Bluetooth  = $this->inputBluetooth;
        $calidad->VolanteRegulable  = $this->inputVolanteRegulable;
        $calidad->VolanteCuero  = $this->inputVolanteCuero;
        $calidad->VelocidadCrucero  = $this->inputVelocidadCrucero;
        $calidad->AndroidCarPlay  = $this->inputAndroidCarPlay;
        $calidad->EspejosExteriores  = $this->inputEspejosExteriores;
        $calidad->EspejosRetractiles  = $this->inputEspejosRetractiles;
        $calidad->AsientosElectricos  = $this->inputAsientosElectricos;
        $calidad->AsientosCalefaccionados  = $this->inputAsientosCalefaccionados;
        $calidad->AsientoTraseroAbatible  = $this->inputAsientoTraseroAbatible;
        $calidad->AperturaMaletaInterior  = $this->inputAperturaMaletaInterior;
        $calidad->TerceraCorrida  = $this->inputTerceraCorrida;
        $calidad->AsientosTermorregulables  = $this->inputAsientosTermorregulables;
        $calidad->PartidaBotón  = $this->inputPartidaBotón;

        $calidad->Alarma = $this->inputAlarma;
        $calidad->SeguimientoGps = $this->inputSeguimientoGps;
        $calidad->Keyless = $this->inputKeyless;
        $calidad->LlaveCodificada = $this->inputLlaveCodificada;
        $calidad->CierreCentralizado = $this->inputCierreCentralizado;
        $calidad->AirgagConductor = $this->inputAirgagConductor;
        $calidad->AirgagAcompañante = $this->inputAirgagAcompañante;
        $calidad->AirgagLateralDelantero = $this->inputAirgagLateralDelantero;
        $calidad->AirgagLateralTrasero = $this->inputAirgagLateralTrasero;
        $calidad->AirgagAdicionales = $this->inputAirgagAdicionales;

        $calidad->FrenosDIsco  = $this->inputFrenosDisco;
        $calidad->FrenosAbs  = $this->inputFrenosAbs;
        $calidad->Esp  = $this->inputEsp;
        $calidad->ControlTraccion  = $this->inputControlTraccion;
        $calidad->IsoFix  = $this->inputIsofix;
        $calidad->SensorRetroceso  = $this->inputSensorRetroceso;
        $calidad->CamaraRetroceso  = $this->inputCamaraRetroceso;
        $calidad->Cámara360  = $this->inputCámara360;
        $calidad->SensorLluvia  = $this->inputSensorLluvia;
        $calidad->SensorLucesAltas  = $this->inputSensorLucesAltas;
        $calidad->SensorCambioPista  = $this->inputSensorCambioPista;
        $calidad->AsistenciaEstacionar  = $this->inputAsistenciaEstacionar;
        $calidad->AsistenciaManejo  = $this->inputAsistenciaManejo;
        $calidad->AsistenciaFrenado  = $this->inputAsistenciaFrenado;
        $calidad->VelocidadCruceroAdaptativa  = $this->inputVelocidadCruceroAdaptativa;
        $calidad->LlantasAleación  = $this->inputLlantasAleación;
        $calidad->NeblinerosDelanteros  = $this->inputNeblinerosDelanteros;
        $calidad->VidriosPolarizados  = $this->inputVidriosPolarizados;
        $calidad->FocosLed  = $this->inputFocosLed;
        $calidad->Spoiler  = $this->inputSpoiler;
        $calidad->BodyKit  = $this->inputBodyKit;
        $calidad->Pisaderas  = $this->inputPisaderas;

        $calidad->save();
        $this->emit('alert',['type'=>'success','message'=>'Datos guardados correctamente']);
    }
}
