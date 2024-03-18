<div>
    @section('stadistics')
        <!-- cards -->
        <div class="flex flex-wrap -mx-3">
            <!-- card1 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Total de Tickets</p>
                                    <h5 class="mb-2 font-bold dark:text-white">{{ $amount }}</h5>

                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                    <i class="fa fa-ticket text-size-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card2 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Ticket en Proceso</p>
                                    <h5 class="mb-2 font-bold dark:text-white">{{ $processing }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                    <i class="fa fa-play text-size-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card3 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Ticket Cerrados</p>
                                    <h5 class="mb-2 font-bold dark:text-white">{{ $closed }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                    <i class="fa fa-times text-size-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card4 -->
            <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Ticket Abiertos</p>
                                    <h5 class="mb-2 font-bold dark:text-white">{{ $open }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                    <i class="fa fa-folder-open-o text-size-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header', 'Accesorios') </p>

                                @if( in_array( auth()->user()->CargoID, array( 2, 4, 5, 6 ) ) )
                                    <a href="{{ route('accessory.config') }}" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                        <i class="fas fa-cog"></i>
                                        Configuración
                                    </a>
                                @endif

                            </div>

                        </div>
                        <div class="flex-auto p-6">
                            <div class="p-0 overflow-x-auto">
                                <div class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Formulario Registro de Ticket Accesorios</p>

                                    <form wire:submit.prevent="submit">
                                        <div class="flex flex-wrap ">
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="title"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Asunto</label>
                                                    <input id="title" name="title" type="text" wire:key="title" wire:model.debounce.500ms="accessoryTicket.title"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('accessoryTicket.title')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('accessoryTicket.title') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="brand"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Prioridad</label>
                                                    <x-simple-select
                                                        name="priority"
                                                        id="priority"
                                                        wire:model="accessoryTicket.priority"
                                                        :options="$priority"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Categoria"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('accessoryTicket.priority')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('accessoryTicket.priority') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="category"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Categoría</label>

                                                    <x-simple-select
                                                        name="category"
                                                        id="category"
                                                        wire:model="accessoryTicket.category"
                                                        :options="$categories"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Categoria"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('accessoryTicket.category')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('accessoryTicket.category') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="subCategory"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Sub
                                                        Categoría</label>

                                                    <x-simple-select
                                                        name="subCategory"
                                                        id="subCategory"
                                                        wire:model="accessoryTicket.subCategory"
                                                        :options="$subCategories"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Sub Categoria"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('accessoryTicket.subCategory')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('accessoryTicket.subCategory') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="brand"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Marca</label>

                                                    <x-simple-select
                                                        name="brand"
                                                        id="brand"
                                                        wire:model="accessoryTicket.management"
                                                        :options="$brands"
                                                        value-field='ID'
                                                        text-field='Gerencia'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Marca - Gerencia"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('accessoryTicket.management')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('accessoryTicket.management') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="businessArea"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Area
                                                        de Negocio</label>

                                                    <x-simple-select
                                                        name="businessArea"
                                                        id="businessArea"
                                                        wire:model="accessoryTicket.zone"
                                                        :options="$businessAreas"
                                                        value-field='ID'
                                                        text-field='TipoSucursal'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Area"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('accessoryTicket.zone')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('accessoryTicket.zone') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="department" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Sucursal - Taller - Departamento
                                                    </label>

                                                    <x-simple-select
                                                        name="department"
                                                        id="department"
                                                        wire:model="accessoryTicket.department"
                                                        :options="$branches"
                                                        value-field='ID'
                                                        text-field='Sucursal'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Sucursal"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('accessoryTicket.zone')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('accessoryTicket.zone') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="detail"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Descripción</label>
                                                    <textarea name="detail" wire:model.debounce.500ms="accessoryTicket.detail"
                                                              class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                    </textarea>
                                                    @error('accessoryTicket.detail')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('accessoryTicket.detail') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="file"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Adjuntar archivo</label>
                                                    <input type="file" name="title" wire:model="file"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('file')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('file') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center" wire:loading>
                                            <div role="status">
                                                <svg class="inline mr-2 w-14 h-14 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                </svg>
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>

                                        @error('agent')
                                        <div class="text-red-500 text-xs">
                                            {{ $errors->first('agent') }}
                                        </div>
                                        @enderror
                                        <button type="submit"
                                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                            Enviar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

