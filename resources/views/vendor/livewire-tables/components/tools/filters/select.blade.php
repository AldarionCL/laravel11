@php
    $theme = $component->getTheme();
@endphp

@if ($theme === 'tailwind')
    <div class="rounded-md shadow-sm">
        <select
            wire:model.stop="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}"
            wire:key="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
            id="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
        >
            @foreach($filter->getOptions() as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
@elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
    <select
        wire:model.stop="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}"
        wire:key="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
        id="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
        class="form-control"
    >
        @foreach($filter->getOptions() as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
@endif
