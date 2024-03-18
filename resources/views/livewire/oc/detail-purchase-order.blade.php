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
                                        Orden de Compra
                                    </p>

                                    <div class="flex-auto pt-6">
                                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                            <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850">
                                                <div class="flex flex-col">
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Empresa : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocPurchaseOrder->business->Empresa }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Marca - Gerencia: <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocPurchaseOrder->brand->Gerencia }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Sucursal - Taller - Departamento : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocPurchaseOrder->branchOffice->Sucursal }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Area de Negocio : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocPurchaseOrder->typeOfBranch->TipoSucursal }}</span></span>
                                                </div>

                                                <div class="flex flex-col ml-auto text-right">

                                                <span class="mb-2 leading-tight text-size-xs dark:text-white/80">N° en OC : <span
                                                        class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocPurchaseOrder->id }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Fecha : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocPurchaseOrder->created_at->format('d-m-Y') }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Proveedor : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocPurchaseOrder->seller->name }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Condiciones de Pago : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $ocPurchaseOrder->payment->name }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Total : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">$ {{ number_format( $ocPurchaseOrder->ocDetailPurchaseOrder->sum('totalPrice') , 0, '', '.') }}</span></span>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    @if( $files )
                                        @foreach( $files as $file )
                                            <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850">
                                                <div class="flex flex-row">
                                                        <span class="mb-2 leading-tight text-size-xs dark:text-white/80">
                                                            Archivo adjunto :
                                                        </span>
                                                    <a href="{{ Storage::url( $file['url'] ) }}" target="_blank">
                                                        <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif

                                    <div class="flex flex-row">
                                        <span class="mb-2 leading-tight text-size-xs dark:text-white/80">
                                            Cotizaciones :
                                        </span>
                                        @foreach( $ocPurchaseOrder->filePurchaseOrder as $file )
                                            <a href="{{ Storage::url( $file->url ) }}" target="_blank" class="ml-2">
                                                <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
                                            </a>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="flex-auto pt-6">
                                <div class="p-0 overflow-x-auto">
                                    <div
                                        class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                        <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                            Detalle Orden de Compra {{ $ocPurchaseOrder->id }}
                                        </p>

                                        <a href="{{ route( 'purchase.order.list') }}" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                            VOLVER
                                        </a>

                                       @if( $ocPurchaseOrder->state === 2 )
                                            <a wire:click.prevent="pdfDownload( {{ $ocPurchaseOrder->id }} )" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                                Documento OC
                                            </a>
                                            {{--<label>
                                                <input wire:model="excenta" class="w-5 h-5 ease text-base -ml-7 rounded-1.4  checked:bg-gradient-to-tl checked:from-blue-500 checked:to-violet-500 after:text-xxs after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" />
                                                <label for="excenta" class="cursor-pointer select-none text-slate-700">OC Exenta</label>
                                            </label>--}}
                                        @endif

                                        <div class="flex flex-wrap pt-6 pb-3">
                                            <table
                                                class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                                <thead class="align-bottom">
                                                <tr>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Codigo
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Articulo
                                                    </th>
                                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Descripción
                                                    </th>
                                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Activo Fijo
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Cantidad
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Cantidad anterior
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Ultimo pedido
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Unitario
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Total
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Presupuesto
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Saldo
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Empresa
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Area de Negocios
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Sección
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Sucursal
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody class="border-t">

                                                @foreach( $ocPurchaseOrder->ocDetailPurchaseOrder as $item)

                                                    <tr>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->ocProduct->sku }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->ocProduct->name }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->description }}
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->ocProduct->Asset === 1 ? 'SI' : 'NO' }}
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center text-size-xs">
                                                                {{ $item->amount }}
                                                            </div>
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center text-size-xs">
                                                                @foreach( $previousOrders as $productFromPreviousOrder )
                                                                    @if( $productFromPreviousOrder->ocProduct_id === $item->ocProduct->id )
                                                                        {{ $productFromPreviousOrder->amount }}
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center text-size-xs">
                                                                @foreach( $previousOrders as $productFromPreviousOrder )
                                                                    @if( $productFromPreviousOrder->ocProduct_id === $item->ocProduct->id )
                                                                        {{ $productFromPreviousOrder->fecha }}
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center text-size-xs">
                                                                $ {{ number_format( $item->unitPrice , 0, '', '.') }}
                                                            </div>
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center text-size-xs">
                                                               $ {{ number_format( $item->totalPrice , 0, '', '.') }}
                                                            </div>
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center text-size-xs">
                                                                $ {{ number_format( $item->ocProduct->accountingBudget->{"M".$ocPurchaseOrder->created_at->format('n')} , 0, '', '.') }}
                                                            </div>
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center text-size-xs {{ $item->ocProduct->accountingBudget->{"S".$ocPurchaseOrder->created_at->format('n')} <= $item->ocProduct->accountingBudget->{"M".$ocPurchaseOrder->created_at->format('n')} ? '' : 'text-red-600' }}">
                                                                $ {{ number_format( ( $item->ocProduct->accountingBudget->{"M".$ocPurchaseOrder->created_at->format('n')} - $item->ocProduct->accountingBudget->{"S".$ocPurchaseOrder->created_at->format('n')} ) , 0, '', '.') }}
                                                            </div>
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->branchOffice->business->Empresa }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->branchOffice->typeOfBranches[0]->TipoSucursal }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->section->Seccion ?? '' }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                        {{ $item->branchOffice->Sucursal }}
                                                        </td>

                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            @can( 'update', $ocPurchaseOrder )
                                                                <x-button-minus-plus :id="$item->id"/>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            @can( 'update', $ocPurchaseOrder )
                                <form wire:submit.prevent="submit">
                                    <div class="flex flex-wrap -mx-3">
                                        <div class="w-full max-w-full px-3 shrink-0 md:w-12 md:flex-0">
                                            <div class="mb-4">
                                                <label for="detail"
                                                       class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Comentario motivo rechazo</label>
                                                <textarea name="message"
                                                          wire:model.debounce.500ms="message"
                                                          class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                            </textarea>
                                                @error('message')
                                                <div class="text-red-500">
                                                    {{ $errors->first('message') }}
                                                </div>
                                                @enderror
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

                                            <button wire:click.prevent="submit"
                                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                                Aprobar
                                            </button>

                                            <button wire:click.prevent="decline"
                                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-500 to-red-600 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                                Rechazar
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

