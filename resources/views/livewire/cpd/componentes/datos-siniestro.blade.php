
<ul class="w-auto text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300">
        <span class="fa fa-wrench text-xs"> </span> Datos del Flujo
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><a href="javascript:imprSelec('divQR')" >{{($cpd->Vin!= null)?generarQR(route('estadocpd',[$cpd->ID]),100) : ''}} </a></li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Estado: </strong>{{@$cpd->EstadoCpd}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Fecha apertura: </strong>{{date('Y-m-d',strtotime($cpd->created_at))}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Origen: </strong>{{$cpd->Origen}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Tiempo de flujo: </strong>{{textoMinutos(MinutosEntreFechas(($cpd->FechaEntrega != null)?$cpd->FechaEntrega : date('Y-m-d H:i:s'),$cpd->created_at),false)}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Sucursal Venta: </strong>{{(@$venta->Sucursal)?@$venta->Sucursal->Sucursal:'-'}}</li>
    <li class="w-full px-4 py-2 border-b border-gray-200"><strong>Vendedor: </strong>{{@$venta->Vendedor->Nombre}}</li>
    <li class="w-full px-4 py-2 rounded-b-lg"><strong>Puesto:</strong> {{($cpd->Cono == null) ? '-' : $cpd->Cono}} <a href="{{route('vehiculostallercpd',[$cpd->SucursalID,'idCpd'=>$cpd->ID])}}" target="_blank"> <span class="text-xs fa fa-reply text-green-600" ></span> <span class="text-xs fa fa-car text-green-600" ></span></a></li>
</ul>

<div class="w-100 text-center border-2 border hidden" id="divQR" style="text-align: center; margin: 0 auto;">
    <p style="text-align: center;">{{($cpd->Vin!= null)?generarQR(route('estadocpd',[$cpd->ID]),190) : ''}}</p>
    <p style="text-align: center;"><img  style="margin: 0 auto;" src="{{asset('assets/img/Logo_Pompeyo.png')}}" width="180px"></p>
    <p style="text-align: center; font-weight: bold; font-size: 18px">{{formato_patente($cpd->Patente)}}</p>
</div>
