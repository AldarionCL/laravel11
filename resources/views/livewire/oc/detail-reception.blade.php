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
                                        Recepcion OC
                                    </p>

                                    <div class="flex-auto pt-6">
                                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                            <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850">
                                                <div class="flex flex-col">
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Empresa : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $reception->ocPurchaseOrder->business->Empresa }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Marca - Gerencia: <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $reception->ocPurchaseOrder->brand->Gerencia }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Sucursal - Taller - Departamento : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $reception->ocPurchaseOrder->branchOffice->Sucursal }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Area de Negocio : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $reception->ocPurchaseOrder->typeOfBranch->TipoSucursal }}</span></span>
                                                </div>

                                                <div class="flex flex-col ml-auto text-right">

                                                <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Factura N° : <span
                                                        class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $reception->id }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Fecha : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $reception->created_at->format('d-m-Y') }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Proveedor : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $reception->ocPurchaseOrder->seller->name }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Condiciones de Pago : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $reception->ocPurchaseOrder->payment->name }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Total : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">$ {{ number_format( $reception->ocPurchaseOrder->ocDetailPurchaseOrder->sum('totalPrice') , 0, '', '.') }}</span></span>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="flex-auto pt-6">
                                <div class="p-0 overflow-x-auto">
                                    <div
                                        class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                        <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                            Detalle Recepcion {{ $reception->id }}
                                        </p>

                                        @if( $reception->ocPurchaseOrder->state === 2 )
                                            <a wire:click.prevent="pdfDownload( {{ $reception->ocPurchaseOrder->id }} )" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                                Documento OC
                                            </a>
                                        @endif

                                        @if( $reception->ocPurchaseOrder->state === 2 )
                                            <a href="{{ Storage::url( $reception->fileReception->url ) }}" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85" target="_blank">
                                                <i class="fa fa-file" aria-hidden="true"></i>
                                                Factura
                                            </a>
                                        @endif

                                        <div class="flex flex-wrap pt-6 pb-3">
                                            <table
                                                class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                                <thead class="align-bottom">
                                                <tr>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        N° de Cuenta
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Cuenta
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Codigo
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Articulo
                                                    </th>
                                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Descripción
                                                    </th>
                                                    <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                        Cantidad
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
                                                        C. Costo
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody class="border-t">

                                                @foreach( $reception->ocPurchaseOrder->ocDetailPurchaseOrder as $item)

                                                    <tr>

                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->ocProduct->account->Account }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->ocProduct->account->name }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->ocProduct->sku }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->ocProduct->name }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->description }}
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center text-size-xs">
                                                                {{ $item->amount }}
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
                                                                $ {{ number_format( $item->ocProduct->accountingBudget->{"M".$reception->ocPurchaseOrder->created_at->format('n')} , 0, '', '.') }}
                                                            </div>
                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center text-size-xs {{ $item->ocProduct->accountingBudget->{"S".$reception->ocPurchaseOrder->created_at->format('n')} >= 0 ? '' : 'text-red-600' }}">
                                                                $ {{ number_format( $item->ocProduct->accountingBudget->{"S".$reception->ocPurchaseOrder->created_at->format('n')} , 0, '', '.') }}
                                                            </div>
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent text-size-xs">
                                                            {{ $item->branchOffice->Sucursal }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

