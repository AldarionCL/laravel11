<ul class="w-100 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300">
        <span class="fa fa-wrench text-xs"> </span> Datos Siniestro
        <a href="#" onclick="Livewire.emit('openModal', 'dyp.componentes.modales.modal-edit-siniestro', {{json_encode(['idDyp'=>$idDyp])}})"> <span class="float-right fa fa-pencil text-default"></span> </a>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Magnitud Daño: </strong>{{@$siniestro->Magnitud}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Tipo: </strong>{{@$dyp->TipoCliente}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Compañía/Cliente: </strong>{{$siniestro->CompaniaSeguro}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>N° Póliza: </strong>{{@$siniestro->NumeroPoliza}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Fecha Emisión: </strong>{{@$siniestro->FechaEmisionPoliza}}</li>
    <li class="w-full px-4 py-2 rounded-b-lg"><strong>Prima Neta: </strong>{{@$siniestro->PrimaNeta}}</li>
</ul>
