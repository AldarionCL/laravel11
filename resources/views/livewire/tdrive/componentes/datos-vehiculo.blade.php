<ul class="w-100 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600 bg-gray-300 dark:bg-gray-900 dark:text-white">
        <span class="fa fa-car text-xs"> </span> Datos Vehículo
        <a href="#" onclick="Livewire.emit('openModal', 'tdrive.componentes.modales.modal-edit-vehiculo', {{json_encode(['idTdrive'=>$idTdrive])}})"> <span class="float-right fa fa-pencil text-default"></span> </a>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Marca: </strong>{{@$tdrive->Marca}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Modelo: </strong>{{$tdrive->Modelo}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Color: </strong>{{@$tdrive->Color}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Patente: </strong>{{$tdrive->Patente}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Vin:</strong> {{$tdrive->Vin}}</li>
    <li class="w-full px-4 py-2 rounded-b-lg"><strong>Puesto:</strong> {{($tdrive->Cono == null) ? '-' : $tdrive->Cono}} <a href="{{route('vehiculostaller',[$tdrive->SucursalID,'idTdrive'=>$tdrive->ID])}}" target="_blank"> <span class="text-xs fa fa-reply text-green-600" ></span> <span class="text-xs fa fa-car text-green-600" ></span></a></li>
</ul>
