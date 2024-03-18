<div>
    <div class="flex flex-wrap">
        <div class="flex-none w-full max-w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="flex-auto p-6">
                            <div class="p-0 overflow-x-auto">
                                <div
                                    class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                        Detalle de Proveedor {{ $provider->id }}</p>

                                    @if( in_array( auth()->user()->CargoID, array( 2, 4, 5, 6 ) ) )
                                        <a href="{{ route('provider.edit', $provider->id) }}" class="inline-block px-8 py-2 mb-4 mr-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-green-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                            <i class="fa fa-pencil"></i>
                                            Editar Proveedores
                                        </a>
                                    @endif

                                    <div class="flex-auto pt-6">
                                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                            <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850">
                                                <div class="flex flex-col">
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Nombre : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $provider->name }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Condiciones de Pago : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $provider->payment_condition }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Contacto : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $provider->contact }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Dirección : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $provider->address }}</span></span>
                                                </div>
                                                <div class="flex flex-col ml-auto text-right">
                                                <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Ciudad : <span
                                                        class="font-semibold text-slate-700 dark:text-white sm:ml-2">
                                                        {{ $provider->city }}
                                                    </span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Codigo Postal : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $provider->postal_code }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Teléfono : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $provider->phone }}</span></span>

                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                    <x-hr/>
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                        Listado de Documentos</p>

                                    {{--<livewire:ticket.comment-table ticket_id="{{ $provider->id }}"/>--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

