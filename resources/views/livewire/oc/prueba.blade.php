<div>
    <a wire:click="pdfDownload({{ $oc }})"
       class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
        <i class="fa fa-search" aria-hidden="true"></i>
        Documento OC
    </a>

    @if( ! $reception )
        <a wire:click="cancel({{ $oc }})"
           class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-red-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
            <i class="fa fa-ban" aria-hidden="true"></i>
            Anular OC
        </a>
    @endif

    @if( $pre_oc )
        <a wire:click="reception({{ $oc }})"
           class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-green-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
            <i class="fa fa-check" aria-hidden="true"></i>
            Recepcionar Todo
        </a>
    @endif

    {{--<label>
        <input wire:model="exempt" class="w-5 h-5 ease text-base -ml-7 rounded-1.4  checked:bg-gradient-to-tl checked:from-blue-500 checked:to-violet-500 after:text-xxs after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" />
        <label for="excenta" class="cursor-pointer select-none text-slate-700">OC Exenta</label>
        {{ $state }}
    </label>--}}
</div>
