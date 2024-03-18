<ul class="w-100 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300">
        <span class="fa fa-user text-xs"> </span> Datos Cliente
        <a href="#" onclick="Livewire.emit('openModal', 'cpd.componentes.modales.modal-edit-cliente', {{json_encode(['idCpd'=>$idCpd])}})"> <span class="float-right fa fa-pencil text-default"></span> </a>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Nombre: </strong>{{$cpd->ClienteNombre}} {{$cpd->ClienteApellido}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Rut: </strong>{{$cpd->ClienteRut}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Teléfono: </strong>{{$cpd->ClienteTelefono}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>E-mail: </strong>{{$cpd->ClienteEmail}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Dirección: </strong>{{$cpd->ClienteDireccion}}</li>
    <li class="w-full px-4 py-2 rounded-b-lg"><strong>Sucursal DyP: </strong>{{@$cpd->Sucursal->Sucursal}}</li>

</ul>

