<form class="card" wire:submit.prevent="submit">
    <div class="card-header">
      Búsqueda de visita
    </div>
    <div class="card-body">
        <div class="row">
            <div class="input-group col-md-6 col-lg-6 col sm-12" id="cajaRut">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Rut</span>
                </div>
                <input type="text" class="form-control" id="inputRut" wire:model="inputRut" placeholder="11.111.111-1">
            </div>
            <div class="input-group col-md-6 col-lg-6 col sm-12">
                <button id="btnBuscar" wire:click="submit" class="btn btn-info btn-sm">Buscar</button>
            </div>

            <div class="col">
                @error('inputRut')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
            @if(@$msj)
            <div class="col-md-6 col-lg-6 col sm-12">
                <div class="alert alert-secondary" role="alert">
                    {{@$msj}}
                </div>
            </div>
            @endif
        </div>
    </div>
</form>

<script>
    $("#inputRut")
        .rut({formatOn: 'keyup', validateOn: 'keyup'});
</script>
