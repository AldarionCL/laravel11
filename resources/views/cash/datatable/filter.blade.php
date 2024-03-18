<div class="min-h-6 mb-0.5 flex items-center">
    <input wire:model="status" {{ $status ? '' : 'checked' }}  id="permission" class="ml-1 rounded-10 duration-300 ease-in-out after:rounded-circle after:shadow-2xl after:duration-300 checked:after:translate-x-5.3 h-5 mt-0.5 relative float-left w-10 cursor-pointer appearance-none border border-solid border-blue-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox"/>
    <label for="permission" class="inline-block pl-3 mb-0 ml-0 font-normal cursor-pointer select-none text-sm text-slate-700">Mis Pendientes</label>
</div>


