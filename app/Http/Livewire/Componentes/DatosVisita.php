<?php

namespace App\Http\Livewire\Componentes;


use App\Models\Agendamientos;
use App\Models\Clientes;
use App\Models\Roma\Commune;
use App\Models\reception\Visitas;
use App\Models\User;
use App\Models\UsuarioSucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class DatosVisita extends Component
{
    #Valores del formulario
    public $inputID;
    public $inputRut;
    public $inputNombres;
    public $inputApellidos;
    public $inputTelefono;
    public $inputEmail;
    public $inputComuna;
    public $inputDireccion;
    public $inputTipoCliente;
    public $inputSucursal;
    public $inputPatente;
    public $inputCantidad;

    #Variables varias
    public $msj;
    public $msjAgenda;
    public $colorfind ;
    public array $communes;
    public array $tipoClientes;
    public array $sucursalesUsuario;



    protected $messages = [
        'inputRut.required' => 'Debe ingresar el rut del visitante',
        'inputRut.min' => 'Ingrese un rut valido',
        'inputNombres.required' => 'Debe ingresar el nombre del visitante',
        'inputTelefono.required' => 'Debe ingresar el teléfono del visitante',
        'inputSucursal.required' => 'Debe ingresar la sucursal a visitar',
        'inputTipoCliente.required' => 'Debe ingresar el motivo de la visita',
    ];

    public function render()
    {
        $comunas = Commune::all();
        return view('recepcion::livewire.componentes.datos-visita',compact('comunas'));
    }

    public function mount()
    {
        $this->communes =  Commune::select('ID', 'Comuna' )->orderBy('Comuna', 'ASC' )->get()->toArray();
        $this->tipoClientes = array(['ID'=>1,'tipo'=>'Cliente'],['ID'=>2,'tipo'=>'Visita (evento)'],['ID'=>3,'tipo'=>'Trabajador externo']);
        $this->sucursalesUsuario = UsuarioSucursal::select('SIS_UsuariosSucursales.SucursalID', 'MA_Sucursales.Sucursal' )->where('UsuarioID',Auth::user()->ID)->where('Activo',1)->join('MA_Sucursales','SIS_UsuariosSucursales.SucursalID','=','MA_Sucursales.ID')->get()->toArray();
    }

    public function search()
    {
        $validatedData = $this->validate([
            'inputRut' => 'required',
        ]);
        $this->msj = 'Cliente no encontrado, debe ingresar sus datos';
        $cliente = '';

        if($this->inputRut != '')
        {
            // comprueba si existe el cliente con ese rut
            $cliente = Clientes::where('Rut',$this->inputRut)->orWhere('Rut',str_replace('-','',str_replace('.','',$this->inputRut)))->first();
            if($cliente)
            {
                $this->msj = 'Cliente encontrado!';
                $this->inputID = $cliente->ID;
                $this->inputRut = $cliente->Rut;
                $this->inputNombres = $cliente->Nombre . " ". $cliente->SegundoNombre;
                $this->inputApellidos = $cliente->Apellido . " ".$cliente->SegundoApellido;
                $this->inputTelefono = $cliente->Telefono;
                $this->inputEmail = $cliente->Email;
                $this->inputComuna = $cliente->ComunaID;
                $this->inputDireccion = $cliente->Direccion;
                $this->colorfind = 'text-success';


                // comprueba si tiene agendamientos
                $agendamientos = Agendamientos::where('EstadoID','=',1)->where('ClienteID',$cliente->ID)->first();

                if($agendamientos)
                    $this->msjAgenda = 'Cliente tiene agendamiento';

            }else
            {
                $this->msj = 'Cliente no encontrado';
                $this->msjAgenda = '';
                $this->inputID = '';
                $this->inputNombres = '';
                $this->inputApellidos = '';
                $this->inputTelefono = '';
                $this->inputEmail = '';
                $this->inputComuna = '';
                $this->inputDireccion = '';
                $this->colorfind = 'text-warning';
            }

        }

        return view('recepcion::livewire.componentes.form-visita');
    }

    public function guardar()
    {
        $validatedData = $this->validate([
            'inputRut' => 'required',
            'inputNombres' => 'required',
            'inputSucursal' => 'required',
            'inputTipoCliente' => 'required'
        ]);
        $exito = '';

        if($this->inputID == '')
        {
            $nuevoCliente = Clientes::firstOrCreate([
                'FechaCreacion' => date('Y-m-d H:i:s'),
                'EventoCreacionID' => 1,
                'UsuarioCreacionID' => Auth::user()->ID,
                'Nombre' => $this->inputNombres,
                'Rut' => str_replace('-','',str_replace('.','',$this->inputRut)),
                'Email' => $this->inputEmail,
                'Telefono' => $this->inputTelefono,
                'Direccion' => $this->inputDireccion,
                'ComunaID' => $this->inputComuna,
                'Apellido' => $this->inputApellidos
            ]);

            if($nuevoCliente) $this->inputID=$nuevoCliente->ID;
        }

        // Crea la nueva visita
        $visita = new Visitas();
        //ClienteID
        if($this->inputID) $visita->ClienteID = $this->inputID;
        $visita->Rut = $this->inputRut;
        $visita->Nombres = $this->inputNombres;
        $visita->Apellidos = $this->inputApellidos;
        $visita->Email = $this->inputEmail;
        $visita->Telefono = $this->inputTelefono;
        $visita->ComunaID = $this->inputComuna;
        $visita->Direccion = $this->inputDireccion;
        $visita->UsuarioID = Auth::user()->ID;
        $visita->TipoCliente = $this->inputTipoCliente;
        $visita->Patente = $this->inputPatente;
        $visita->Cantidad = $this->inputCantidad;
        if($this->inputSucursal) $visita->SucursalID = $this->inputSucursal;
        $visita->FechaCreacion = date('Y-m-d H:i:s');
        $visita->created_at = date('Y-m-d H:i:s');

        if($visita->save())
        {
            $this->inputID = '';
            $this->inputRut = '';
            $this->inputNombres = '';
            $this->inputApellidos = '';
            $this->inputTelefono = '';
            $this->inputEmail = '';
            $this->inputComuna = '';
            $this->inputDireccion = '';
            $this->inputTipoCliente = '';
            $this->inputSucursal = '';
            $this->inputPatente = '';
            $this->inputCantidad = '';
            $this->msj = '';
            $this->msjAgenda = '';

            $exito = 'ok';


            $this->emit("updateDatatableVisita");

            return view('recepcion::livewire.componentes.form-visita',compact('exito'));

        }

        $this->emit("updateDatatableVisita");

        return view('recepcion::livewire.componentes.form-visita');

    }
}
