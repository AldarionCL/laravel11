<div class="fixed z-2 w-full h-16 max-w-lg -translate-x-1/2 bg-blue-50 text-info border border-gray-200 rounded-full bottom-4 left-1/2 dark:bg-gray-700 dark:border-gray-600">
    <div class="grid h-full max-w-lg grid-cols-6 mx-auto">
        <a href="{{route('flujotdrive',[$tdrive->ID])}}" data-tooltip-target="tooltip-home" type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-l-full hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <span class="fa fa-home"></span>
            <small class="">TDRIVE</small>
        </a>
        <div id="tooltip-home" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            TDRIVE
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <button onclick="Livewire.emit('openModal', 'tdrive.componentes.modales.modal-archivos', {{json_encode(['idTdrive'=>$tdrive->ID])}})"
            data-tooltip-target="tooltip-wallet" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <span class="fa fa-folder"></span>
            <small class="">Archivos</small>
        </button>
        <div id="tooltip-wallet" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Archivos
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>



        <button onclick="Livewire.emit('openModal', 'tdrive.componentes.modales.modal-nueva-tarea', {{json_encode(['idTdrive'=>$tdrive->ID])}})"
                data-tooltip-target="tooltip-settings" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <span class="fa fa-plus"></span>
            <small class="">Nueva&nbsp;Tarea</small>
        </button>
        <div id="tooltip-settings" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Crear Tarea
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <a href="{{($idTaller != null) ? route('tallertdrive',[$idTaller]) : ''}}" data-tooltip-target="tooltip-profile" type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-r-full hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <span class="fa fa-wrench"></span>
            <small class="">Taller</small>
        </a>
        <div id="tooltip-profile" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Taller
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <a href="{{route('ordenTrabajo',[$tdrive->ID])}}" target="_blank" data-tooltip-target="tooltip-profile" type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-r-full hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <span class="fa phpdebugbar-fa-tasks"></span>
            <small class="">OT</small>
        </a>
        <div id="tooltip-wallet" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            OT
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>


        <button onclick="Livewire.emit('openModal', 'tdrive.componentes.modales.modal-logs', {{json_encode(['idTdrive'=>$tdrive->ID])}})"
                data-tooltip-target="tooltip-settings" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <span class="fa fa-sliders"></span>
            <small class="">Log</small>
        </button>
        <div id="tooltip-settings" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Log de acciones
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

    </div>
</div>
