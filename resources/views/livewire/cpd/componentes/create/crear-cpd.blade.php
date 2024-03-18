<form action="{{route('guardarcpd')}}" enctype="multipart/form-data" method="POST">
@csrf
    <livewire:cpd.componentes.create.data-siniestro />

{{--
    <livewire:cpd.componentes.create.data-cliente />
--}}

    <livewire:cpd.componentes.create.data-vehiculo />


    <button type="submit" class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-cyan-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Crear CPD</button>
</form>
<hr>
<br>
<H3>Crear desde ID Venta</H3>
<div class="flex flex-wrap p-2 rounded-lg border border-1 border-blue-200 p-2  items-center mb-4 text-gray-900 border-blue-300 ">

    <div class="flex flex-wrap w-full">
        <div class="p-2 w-1/2">
            <label for="inputIdVenta">ID Venta</label>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                  <i class="fas fa-car" aria-hidden="true"></i>
                </span>
                <input type="text" name="inputIdVenta" id="inputIdVenta" wire:model="inputIdVenta" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder=""/>
                @error('inputIdVenta')<small><span class="error text-danger">{{ $message }}</span> </small> @enderror
            </div>
        </div>

        <div class="p-2 w-1/2">
            <button  onclick="javascript:creaVenta()" class="mt-5 inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Crear</button>
        </div>

    </div>

</div>

<script>
    function creaVenta(){
        var idVenta = $('#inputIdVenta').val();
        alert(idVenta);
        window.location.href = '/api/creacpdventas?idVenta='+idVenta;
    }
</script>

