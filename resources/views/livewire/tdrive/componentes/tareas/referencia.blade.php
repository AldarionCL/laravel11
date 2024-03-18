<div class="text-sm text-gray-600 dark:text-white/60">
    <p class="font-bold border-b-2">Datos Referencia</p>
    <div class="flex flex-wrap w-100 w-full">
        @if($tareaRef)
            @foreach($tareaRef->Datos as $datos)
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4">
                    <strong>{{@$datos->Campos->Campo}}: </strong> {{$datos->Valor}}
                </div>
            @endforeach
        @else
            <p>No hay tarea de referencia</p>
        @endif
    </div>
</div>
