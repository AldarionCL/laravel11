<div class="flex space-x-1 justify-around">
{{--
    @if($column->Fecha_salida == null) <a href="{{route('marcar_salida',[$column->ID])}}"> <i class="text-warning fa fa-hourglass-start text-size-lg" aria-hidden="true"></i> En sucursal</a>
--}}
    @if($column->Fecha_salida == null)
        <button type="button" class="btnRetiro" onclick="marcarRetiro({{$column->ID}})" data-id="{{$column->ID}}"> <i class="text-warning fa fa-hourglass-start text-size-lg" aria-hidden="true"></i> En sucursal</button>
    @else
        <p > <i class="text-danger fa fa-sign-out  text-size-lg" aria-hidden="true"></i> Se retiró</p>
    @endif
</div>

