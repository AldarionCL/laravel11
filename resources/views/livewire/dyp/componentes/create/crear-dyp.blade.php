<form action="{{route('guardardyp')}}" enctype="multipart/form-data" method="POST">
@csrf
    <livewire:dyp.componentes.create.data-siniestro />

    <livewire:dyp.componentes.create.data-cliente />

    <livewire:dyp.componentes.create.data-vehiculo />


    <button type="submit" class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-cyan-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Crear DYP</button>
</form>
