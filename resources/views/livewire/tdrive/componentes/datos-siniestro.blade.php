<ul class="w-100 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600 bg-gray-300 dark:bg-gray-900 dark:text-white">
        <span class="fa fa-wrench text-xs"> </span> Datos Siniestro
        <a href="#" onclick="Livewire.emit('openModal', 'tdrive.componentes.modales.modal-edit-siniestro', {{json_encode(['idTdrive'=>$idTdrive])}})"> <span class="float-right fa fa-pencil text-default"></span> </a>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Magnitud Daño: </strong>{{@$siniestro->Magnitud}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Tipo: </strong>{{@$tdrive->TipoCliente}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Compañía/Cliente: </strong>{{$siniestro->CompaniaSeguro}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>N° Póliza: </strong>{{@$siniestro->NumeroPoliza}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"><strong>Fecha Emisión: </strong>{{@$siniestro->FechaEmisionPoliza}}</li>
    <li class="w-full px-4 py-2 rounded-b-lg"><strong>Prima Neta: </strong>{{@$siniestro->PrimaNeta}}</li>
</ul>
