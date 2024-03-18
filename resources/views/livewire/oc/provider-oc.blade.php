<div>
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header', 'Proveedor') </p>

                                @if( in_array( auth()->user()->CargoID, array( 2, 4, 5, 6 ) ) )
                                    <a href="{{ route('purchase.order.provider-list') }}" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                        <i class="fas fa-list"></i>
                                        Listado Proveedores
                                    </a>
                                @endif

                            </div>

                        </div>
                        <div class="flex-auto p-6">
                            <div class="p-0 overflow-x-auto">
                                <div class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Formulario Registro de Proveedores</p>

                                    <form wire:submit.prevent="submit">
                                        <div class="flex flex-wrap ">
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="name"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Nombre</label>
                                                    <input type="text" wire:key="name" wire:model.debounce.500ms="provider.name"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.name')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.name') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="rut"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">RUT</label>
                                                    <input type="text" wire:key="rut" wire:model.debounce.500ms="provider.rut"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.rut')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.rut') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="payment_condition"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Condiciones de Pago</label>
                                                    <select wire:key="payment_condition" wire:model="provider.payment_condition"
                                                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                        <option value="">Seleccione...</option>
                                                        <option value="30">30</option>
                                                        <option value="60">60</option>
                                                        <option value="90">90</option>
                                                    </select>
                                                    @error('provider.payment_condition')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.payment_condition') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="flex flex-wrap ">
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="address"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Dirección</label>
                                                    <input type="text" wire:key="address" wire:model.debounce.500ms="provider.address"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.address')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.address') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="city"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Ciudad</label>
                                                    <input type="text" wire:key="city" wire:model.debounce.500ms="provider.city"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.city')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.city') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="postal_code"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Codigo Postal</label>
                                                    <input type="text" wire:key="postal_code" wire:model.debounce.500ms="provider.postal_code"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.postal_code')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.postal_code') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap ">
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="phone"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Teléfono</label>
                                                    <input type="text" wire:key="phone" wire:model.debounce.500ms="provider.phone"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.phone')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.phone') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="email"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Correo</label>
                                                    <input type="text" wire:key="email" wire:model.debounce.500ms="provider.email"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.email')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.email') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="contact"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Contacto</label>
                                                    <input type="text" wire:key="contact" wire:model.debounce.500ms="provider.contact"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.contact')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.contact') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="flex flex-wrap ">
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="cuenta"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Cuenta</label>
                                                    <input type="text" wire:key="cuenta" wire:model.debounce.500ms="provider.cuenta"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.cuenta')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.cuenta') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="costCenter"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Centro de Costo</label>
                                                    <input type="text" wire:key="costCenter" wire:model.debounce.500ms="provider.costCenter"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.costCenter')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.costCenter') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="gasto"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Gasto</label>
                                                    <input type="text" wire:key="gasto" wire:model.debounce.500ms="provider.gasto"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('provider.gasto')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('provider.gasto') }}
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
