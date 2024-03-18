    <div class="row">

    @foreach($agendamientos as $key => $agendamiento)

            <div class="col-sm-12 col-md-4">
            <div class="card shadow-md rounded mb-3">
                <div class="card-header">
                    <span class="fa fa-user"> </span> {{$agendamiento["Nombre"]}} {{$agendamiento["Rut"]}}
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-6">
                            <span class="fa fa-clock "> {{ $agendamiento["Fecha_agenda"] }}</span>
                        </div>
                        <div class="col-6 text-right">
                            <span class="fa fa-clock {{@$agendamiento["Color"]}}"> {{$agendamiento["Fecha_termino"]}}</span>
                        </div>
                    </div>

                    <ul class="list-group text-sm" >
                        <li class="list-group-item active bg-info">Servicio: {{@$agendamiento["Servicio"]}}</li>
                        <li class="list-group-item ">Fecha: {{$agendamiento["Fecha"]}}</li>
                        <li class="list-group-item ">Subtipo: {{$agendamiento["Subtipo"]}}</li>
                       <li class="list-group-item">Marca: {{@$agendamiento["Marca"]}}</li>
                       <li class="list-group-item">Sucursal: {{@$agendamiento["Sucursal"]}}</li>
                       <li class="list-group-item">Sucursal: {{@$agendamiento["Tipo"]}}</li>
                        <li class="list-group-item">Comentario: {{@$agendamiento["Comentario"]}}</li>
                    </ul>
                </div>
                <div class="card-footer">
                    @livewire('reception.buscadores.en-sucursal' , [ 'idCliente' => $agendamiento['ClienteID'],  'fecha'=> $agendamiento["Fecha"] ] )
                </div>
            </div>
        </div>
    @endforeach
</div>





