<table class="w-full text-left text-size-xxs p-2">
    <tr class="text-center">
        <td colspan="4" class="font-bold">Vista externa</td>
    </tr>
    <tr>
        <td class="font-bold">Tipo de daño</td>
        <td class="font-bold">Costo</td>
        <td class="font-bold">Comentario</td>
        <td class="font-bold">Ubicación</td>
        <td class="font-bold">Acción</td>
    </tr>
    @if(isset($inspeccion->Detalles))
        @foreach($inspeccion->Detalles as $key => $detalle)
            <tr>
                <td class="font-bold"> <input type="text" readonly wire:model.debounce.500ms="detalle.{{$key}}.TipoDanio"></td>
                <td class="font-bold"><input type="text" readonly wire:model.debounce.500ms="detalle.{{$key}}.Costo"></td>
                <td class="font-bold"> <input type="text" readonly wire:model.debounce.500ms="detalle.{{$key}}.Comentario"></td>
                <td class="font-bold"> <input type="text" readonly wire:model.debounce.500ms="detalle.{{$key}}.Ubicacion"></td>
                <td class="font-bold"><div><button type="button" wire:click="delete({{$detalle["ID"]}})" class="bg-gradient-to-tl from-red-500 to-red-400 text-white font-bold py-2 px-4 rounded">-</button> </div></td>
            </tr>
        @endforeach
    @endif
    <tr>
        <td class="font-bold"><input type="text" wire:model.debounce.500ms="detalle.nuevo.TipoDanio"></td>
        <td class="font-bold"><input type="text" wire:model.debounce.500ms="detalle.nuevo.Costo" placeholder="$"></td>
        <td class="font-bold"><input type="text" wire:model.debounce.500ms="detalle.nuevo.Comentario"></td>
        <td class="font-bold"><input type="text" wire:model.debounce.500ms="detalle.nuevo.Ubicacion"></td>
        <td class="font-bold"><button type="button" wire:click="add()" class="bg-gradient-to-tl from-green-500 to-green-400 text-white font-bold py-2 px-4 rounded">+</button> </td>
    </tr>
</table>
