<div>
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header',  "Formulario de Usuarios" ) </p>
                            </div>

                        </div>
                        <div class="flex-auto p-6">
                            <div class="p-0">
                                <div
                                    class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                        Formulario Registro de Usuarios
                                    </p>
                                    <form wire:submit.prevent="submit">
                                        <div x-data="{}" class="flex flex-wrap ">

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="name"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Nombre
                                                    </label>


                                                    <input type="text" id="name" name="name" wire:key="name"
                                                           wire:model.debounce.500ms="user.Nombre"
                                                           class=" focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('user.Nombre')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('user.Nombre') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="email"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Correo
                                                    </label>


                                                    <input type="text" id="email" email="email" wire:key="email"
                                                           wire:model.debounce.500ms="user.Email"
                                                           class=" focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('user.Email')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('user.Email') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="rut"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        RUT
                                                    </label>


                                                    <input x-mask="99.999.999-9"
                                                           type="text" id="rut" rut="rut" wire:key="rut"
                                                           wire:model.debounce.500ms="user.Rut"
                                                           class=" focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('user.Rut')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('user.Rut') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="fono"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Fono Oficina
                                                    </label>


                                                    <input x-mask="999999999"
                                                           type="text" id="fono" fono="fono" wire:key="fono"
                                                           wire:model.debounce.500ms="user.TelefonoOficina"
                                                           class=" focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('user.TelefonoOficina')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('user.TelefonoOficina') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="movil"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Celular
                                                    </label>


                                                    <input x-mask="999999999"
                                                           type="text" id="movil" movil="movil" wire:key="movil"
                                                           wire:model.debounce.500ms="user.Celular"
                                                           class=" focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('user.Celular')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('user.Celular') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="profile"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Perfil
                                                    </label>

                                                    <x-simple-select
                                                        name="profile"
                                                        id="profile"
                                                        wire:model="user.PerfilID"
                                                        :options="$profile"
                                                        value-field='ID'
                                                        text-field='Perfil'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Perfil"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />

                                                    @error('user.PerfilID')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('user.PerfilID') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="position"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Cargo
                                                    </label>

                                                    <x-simple-select
                                                        name="position"
                                                        id="position"
                                                        wire:model="user.CargoID"
                                                        :options="$position"
                                                        value-field='ID'
                                                        text-field='Cargo'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Cargo"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />

                                                    @error('user.CargoID')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('user.CargoID') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="detail"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Detalle
                                                    </label>

                                                    <x-simple-select
                                                        name="detail"
                                                        id="detail"
                                                        wire:model="user.DetalleID"
                                                        :options="$detail"
                                                        value-field='ID'
                                                        text-field='Detalle'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Detalle"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />

                                                    @error('user.DetalleID')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('user.DetalleID') }}
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

