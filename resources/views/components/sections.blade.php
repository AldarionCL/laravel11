<div>
    @php
        $data = App\Models\Section::select('ID', 'Seccion')->where('TipoSucursalID', $zone )->get()->toArray();
    @endphp
    <x-simple-select
        on-select="selected"
        name="detail.{{ $key }}"
        value="{{ $item ?? '' }}"
        id="idSectionDetail"
        :options="$data"
        value-field='ID'
        text-field='Seccion'
        placeholder="Seleccione ..."
        search-input-placeholder="Buscar Seccion"
        :searchable="true"
        class="form-select"
        no-options="No hay datos"
    />
</div>
