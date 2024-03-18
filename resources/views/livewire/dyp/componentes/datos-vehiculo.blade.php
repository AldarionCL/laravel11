<ul class="w-100 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300">
        <span class="fa fa-car text-xs"> </span> Datos Vehículo
        <a href="#" onclick="Livewire.emit('openModal', 'dyp.componentes.modales.modal-edit-vehiculo', {{json_encode(['idDyp'=>$idDyp])}})"> <span class="float-right fa fa-pencil text-default"></span> </a>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Marca: </strong>{{@$dyp->Marca}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Modelo: </strong>{{$dyp->Modelo}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Color: </strong>{{@$dyp->Color}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Patente: </strong>{{$dyp->Patente}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Vin:</strong> {{$dyp->Vin}}</li>
    <li class="w-full px-4 py-2 rounded-b-lg"><strong>Puesto:</strong> {{($dyp->Cono == null) ? '-' : $dyp->Cono}} <a href="{{route('vehiculostaller',[$dyp->SucursalID,'idDyp'=>$dyp->ID])}}" target="_blank"> <span class="text-xs fa fa-reply text-green-600" ></span> <span class="text-xs fa fa-car text-green-600" ></span></a></li>
</ul>
