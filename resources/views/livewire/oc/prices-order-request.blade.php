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
                                        Asignación de Precios
                                    </p>

                                    <div class="flex-auto pt-6">
                                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                            <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850">
                                                <div class="flex flex-col">
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Empresa : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocOrderRequest->business->Empresa }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Marca - Gerencia: <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocOrderRequest->brand->Gerencia }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Sucursal - Taller - Departamento : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocOrderRequest->branchOffice->Sucursal }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Area de Negocio : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocOrderRequest->typeOfBranch->TipoSucursal }}</span></span>
                                                </div>

                                                <div class="flex flex-col ml-auto text-right">

                                                <span class="mb-2 leading-tight text-size-xs dark:text-white/80">N° : <span
                                                        class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocOrderRequest->id }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Fecha : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocOrderRequest->created_at->format('d-m-Y')}}</span></span>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div x-data class="flex-auto pt-6">
                                <div class="p-0 overflow-x-auto">
                                    <div
                                        class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">

                                        <div class="flex flex-wrap pt-6 pb-3">
                                            <table aria-describedby="order"
                                                class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                                <thead class="align-bottom">
                                                <tr>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        En Stock
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Codigo
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Articulo
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Descripción
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Cantidad
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        P. Unitario Neto
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Total
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="border-t">

                                                @foreach( $ocDetailOrderRequest as $index => $item )
                                                    <div>
                                                            <tr>
                                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                                    <label>
                                                                        <input wire:click="inStock( {{ $item['id'] }} )" class="w-5 h-5 ease text-base rounded-1.4  checked:bg-gradient-to-tl checked:from-blue-500 checked:to-violet-500 after:text-xxs after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" />
                                                                    </label>
                                                                </td>
                                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                                    {{ $item['oc_product']['sku'] }}
                                                                </td>
                                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                                    {{ $item['oc_product']['name'] }}
                                                                </td>
                                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                                    {{ $item['description'] }}
                                                                </td>
                                                                <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                                    <div class="flex items-center justify-center">
                                                                        {{ $item['amount'] }}
                                                                    </div>
                                                                </td>
                                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">

                                                                    @if( $editedDetailIndex === $index || $editedDetailField === $index . '.unitPrice')
                                                                        <input wire:key="{{ $index }}" type="text"
                                                                               @clik.away="$wire.editedDetailField === '{{ $index }}.unitPrice' ? $wire.saveDetail( {{ $index }} ) : null "
                                                                               wire:model.defer="ocDetailOrderRequest.{{ $index }}.unitPrice"
                                                                        >

                                                                        @if( $errors->has( 'ocDetailOrderRequest.' . $index . '.unitPrice' ) )
                                                                            <div class="text-red-500 text-xs">
                                                                                {{ $errors->first( 'ocDetailOrderRequest.' . $index . '.unitPrice' ) }}
                                                                            </div>
                                                                        @endif

                                                                    @else

                                                                        <div>
                                                                            {{ $item['unitPrice'] }}
                                                                        </div>

                                                                    @endif

                                                                </td>
                                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                                    <div class="flex items-center justify-center">
                                                                        {{ $item['totalPrice'] }}
                                                                    </div>
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">

                                                                    @if( $editedDetailIndex !== $index )
                                                                        <button
                                                                            class="inline-block px-4 py-1.5 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-500 to-red-600 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md"
                                                                            wire:click.prevent="editDetail( {{ $index }} )"
                                                                        >
                                                                            Editar
                                                                        </button>
                                                                    @else
                                                                        <button
                                                                            class="inline-block px-4 py-1.5 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md"
                                                                            wire:click.prevent="saveDetail( {{ $index }} )"
                                                                        >
                                                                            Enviar
                                                                        </button>
                                                                    @endif

                                                                </td>
                                                            </tr>
                                                    </div>

                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>


                                <form wire:submit.prevent="submit">
                                    <div class="flex flex-wrap -mx-3">

                                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                            <div class="mb-4">
                                                <label for="file"
                                                       class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                    Adjuntar cotización
                                                </label>

                                                <input type="file" wire:model="files" multiple
                                                       class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                @if (count($errors) > 0)
                                                    <div class="text-red-500 text-xs">
                                                            @foreach ($errors->all() as $error)
                                                                {{ $error }}
                                                            @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="w-full max-w-full px-3 shrink-0 md:w-12 md:flex-0">
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

                                            <button type="submit"
                                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                                Guardar
                                            </button>

                                        </div>
                                    </div>
                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
