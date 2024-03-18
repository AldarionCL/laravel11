<div>
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header',  "Cliente" ) </p>
                            </div>

                        </div>
                        <div class="flex-auto p-6">
                            <div class="p-0 overflow-x-auto">
                                <div
                                    class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                        Formulario Edición de Cliente
                                    </p>
                                    <form wire:submit.prevent="submit">
                                        <div class="flex flex-wrap ">

                                            <div class="max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="rut"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        RUT
                                                    </label>
                                                    <input type="text" wire:key="rut" wire:model.debounce.500ms="customer.Rut"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('customer.Rut')
                                                        <div class="text-red-500 text-size-xs">
                                                            {{ $errors->first('customer.Rut') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="Nombre"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Nombre
                                                    </label>
                                                    <input type="text" wire:key="Nombre" wire:model.debounce.500ms="customer.Nombre"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('customer.Nombre')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('customer.Nombre') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="Email"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Email
                                                    </label>
                                                    <input type="text" wire:key="Email" wire:model.debounce.500ms="customer.Email"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('customer.Email')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('customer.Email') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="Telefono"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Telefono
                                                    </label>
                                                    <input type="text" wire:key="Telefono" wire:model.debounce.500ms="customer.Telefono"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('customer.Telefono')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('customer.Telefono') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="FechaNacimiento"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Fecha de Nacimiento
                                                    </label>
                                                    <input type="text" wire:key="FechaNacimiento" wire:model.debounce.500ms="customer.FechaNacimiento"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('customer.FechaNacimiento')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('customer.FechaNacimiento') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="Direccion"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Dirección
                                                    </label>
                                                    <input type="text" wire:key="Direccion" wire:model.debounce.500ms="customer.Direccion"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('customer.Direccion')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('customer.Direccion') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="ComunaID"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Comuna
                                                    </label>

                                                    <x-simple-select
                                                        name="commune"
                                                        id="commune"
                                                        wire:model="customer.ComunaID"
                                                        :options="$communes"
                                                        value-field='ID'
                                                        text-field='Comuna'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Comuna"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />

                                                    @error('customer.ComunaID')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('customer.ComunaID') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="region"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Region
                                                    </label>

                                                    <x-simple-select
                                                        name="region"
                                                        id="region"
                                                        wire:model="customer.RegionID"
                                                        :options="$regions"
                                                        value-field='ID'
                                                        text-field='Region'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Región"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />

                                                    @error('customer.RegionID')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('customer.RegionID') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="EstadoCivilID"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Estado Civil
                                                    </label>
                                                    <input type="text" wire:key="EstadoCivilID" wire:model.debounce.500ms="customer.EstadoCivilID"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('customer.EstadoCivilID')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('customer.EstadoCivilID') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="ProfesionID"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Profesion
                                                    </label>
                                                    <input type="text" wire:key="ProfesionID" wire:model.debounce.500ms="customer.ProfesionID"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('customer.ProfesionID')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('customer.ProfesionID') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="w-full text-center mx-4" wire:loading>
                                            <div role="status">
                                                <svg
                                                    class="inline mr-2 w-14 h-14 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                    viewBox="0 0 100 101" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                        fill="currentColor"/>
                                                    <path
                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                        fill="currentFill"/>
                                                </svg>
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <button wire:click="remove"
                                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-500 to-red-600 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                            Anular
                                        </button>
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
