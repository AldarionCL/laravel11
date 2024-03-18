<ul class="w-100 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600 bg-gray-300 dark:bg-gray-900 dark:text-white">
        <span class="fa fa-user text-xs"> </span> Datos Cliente
        <a href="#" onclick="Livewire.emit('openModal', 'tdrive.componentes.modales.modal-edit-cliente', {{json_encode(['idTdrive'=>$idTdrive])}})"> <span class="float-right fa fa-pencil text-default"></span> </a>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Nombre: </strong>{{$tdrive->ClienteNombre}} {{$tdrive->ClienteApellido}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Rut: </strong>{{$tdrive->ClienteRut}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Teléfono: </strong>{{$tdrive->ClienteTelefono}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>E-mail: </strong>{{$tdrive->ClienteEmail}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Dirección: </strong>{{$tdrive->ClienteDireccion}}</li>
    <li class="w-full px-4 py-2 rounded-b-lg"><strong>Sucursal DyP: </strong>{{@$tdrive->Sucursal->Sucursal}}</li>

</ul>

