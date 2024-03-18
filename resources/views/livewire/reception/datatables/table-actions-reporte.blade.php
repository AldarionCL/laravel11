<div class="flex space-x-1 align-content-center">
    @if($column->Fecha_salida == null)  <i class="text-warning fa fa-hourglass-start  text-size-lg" aria-hidden="true"> </i> <small>En sucursal</small>
    @else <i class="text-danger fa fa-sign-out text-size-lg" aria-hidden="true"></i> <small>Se retiró</small> @endif
</div>

