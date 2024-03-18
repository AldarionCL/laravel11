<ul class="w-auto  text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300">
        <span class="fa fa-car text-xs"> </span> Datos Vehículo VPP
        <a href="#" onclick="Livewire.emit('openModal', 'cpd.componentes.modales.modal-edit-vehiculo', {{json_encode(['idCpd'=>$idCpd])}})"> <span class="float-right fa fa-pencil text-default"></span> </a>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Marca: </strong>{{@$cpd->Marca}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Modelo: </strong>{{$cpd->Modelo}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Patente: </strong>{{$cpd->Patente}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Año:</strong> {{@$vpp->Anio}}</li>
    <li class="w-full px-4 py-2 rounded-b-lg"><strong>Tomador:</strong> {{@$vpp->Tomador->TomadorVPP}}</li>
</ul>

<ul class="w-auto  text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300">
        <span class="fa fa-car text-xs"> </span> Datos Vehículo Venta
        {{--
                <a href="#" onclick="Livewire.emit('openModal', 'cpd.componentes.modales.modal-edit-vehiculo', {{json_encode(['idCpd'=>$idCpd])}})"> <span class="float-right fa fa-pencil text-default"></span> </a>
        --}}
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Marca: </strong>{{@$venta->Marca->Marca}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Modelo: </strong>{{@$venta->Modelo->Modelo}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Patente: </strong>{{@$venta->Patente}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Vin:</strong> {{@$venta->Vin}}</li>
    <li class="w-full px-4 py-2 rounded-b-lg"><strong>Cajón:</strong> {{@$venta->Cajon}}</li>
</ul>
