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
                                        Detalle de Ticket N° {{ $ticket->id }}</p>

                                    @if($ticket->assigned === auth()->user()->ID && $ticket->state !== 3 )
                                        <div class="flex items-center">
                                            <button wire:click="closeTicket( {{ $ticket->id }})"
                                                    class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                                <i class="fa fa-times-circle-o"></i>
                                                Cerrar Ticket
                                            </button>
                                        </div>
                                    @endif

                                    <div class="flex-auto pt-6">
                                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                            <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850">
                                                <div class="flex flex-col">
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Asunto : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ticket->title }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Marca - Gerencia: <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ticket->gerencia->Gerencia }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Area de Negocio : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ticket->typeOfBranch->TipoSucursal }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Sucursal - Taller - Departamento : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ticket->office->Sucursal }}</span></span>
                                                </div>
                                                <div class="flex flex-col ml-auto text-right">
                                                <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Estado : <span
                                                        class="font-semibold text-slate-700 dark:text-white sm:ml-2">
                                                        @if ($ticket->state === 1)
                                                            Abierto
                                                        @elseif ($ticket->state === 2)
                                                            En Proceso
                                                        @else
                                                            Cerrado
                                                        @endif
                                                    </span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Fecha de Ingreso : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ticket->created_at->format('d-m-Y') }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Ultima Respuesta : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ticket->created_at->format('d-m-Y')}}</span></span>

                                                </div>
                                            </li>

                                            <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850">
                                                <div class="flex flex-col">
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Detalle : </span>
                                                    <span
                                                        class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ticket->detail }}</span>
                                                </div>
                                            </li>

                                            @if( $ticket->file )
                                                <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850">
                                                    <div class="flex flex-col">
                                                        <span
                                                            class="mb-2 leading-tight text-size-xs dark:text-white/80">Archivo adjunto : </span>
                                                        <a href="{{ Storage::url( $ticket->file->url ) }}"
                                                           target="_blank">
                                                            <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    @if( $ticket->state !== 3 )
                                        <form wire:submit.prevent="submit">
                                            <div class="flex flex-wrap -mx-3">

                                                <div class="w-full max-w-full px-3 shrink-0 md:w-12 md:flex-0">
                                                    <div class="mb-4">
                                                        <label for="detail"
                                                               class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Descripción</label>
                                                        <textarea name="detail"
                                                                  wire:model.debounce.500ms="comment.detail"
                                                                  class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                    </textarea>
                                                        @error('comment.detail')
                                                        <div class="text-red-500">
                                                            {{ $errors->first('comment.detail') }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                    <div class="mb-4">
                                                        <label for="file"
                                                               class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Adjuntar
                                                            archivo</label>
                                                        <input type="file" name="title" wire:model="file"
                                                               class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                        @error('file')
                                                        <div class="text-red-500">
                                                            {{ $errors->first('file') }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center" wire:loading>
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
                                            <button type="submit"
                                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                                Enviar
                                            </button>
                                        </form>
                                    @endif

                                    <x-hr/>
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                        Listado de Seguimientos</p>

                                    <livewire:accessory.accessory-comment-table ticket_id="{{ $ticket->id }}"/>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
