<div>
    <div class="w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button wire:click="close" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Listado de Pedidos</h3>
                <form class="space-y-6" wire:submit.prevent="submit">
                    <div>
                        <label for="department"
                               class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                            N° de Solicitud
                        </label>
                        {{--<select id="order" wire:key="order" wire:model="order" multiple
                                >
                            <option value="">Seleccione...</option>
                            @foreach( $orderRequest as $item)
                                <option value="{{ $item->id }}">{{ $item->id }} - {{ $item->branchOffice->Sucursal }}</option>
                            @endforeach
                        </select>--}}

                        <x-simple-select
                            name="condition"
                            multiple="true"
                            id="condition"
                            wire:model="order"
                            :options="$orderRequest"
                            value-field='id'
                            text-field='name'
                            placeholder="Seleccione ..."
                            search-input-placeholder="Buscar Condición"
                            :searchable="true"
                            class="form-select"
                            no-options="No hay datos"
                        />

                        @error('order')
                        <div class="text-red-500 text-size-xs">
                            {{ $errors->first('order') }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="w-full inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Añadir a OC </button>
                </form>
            </div>
        </div>
    </div>
</div>
