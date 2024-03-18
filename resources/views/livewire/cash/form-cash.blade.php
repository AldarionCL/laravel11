<div>
    <div>
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0">

                            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                                <div class="flex items-center">
                                    <p class="mb-0 dark:text-white/80">@yield('title-header',  "CAJA CHICA") </p>
                                </div>
                            </div>

                            <div class="flex-auto p-6">
                                <div class="p-0">
                                    <div class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                        <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                            Formulario Rendición de Caja Chica
                                        </p>

                                        <div class="flex flex-wrap ">

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="bank"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Bancos
                                                    </label>
                                                    <x-simple-select
                                                        name="bank"
                                                        id="bank"
                                                        wire:model="bank"
                                                        :options="$banks"
                                                        value-field='ID'
                                                        text-field='Banco'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Banco"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('bank')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('bank') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                            <div class="mb-4">
                                                <label for="account_type"
                                                       class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                    Tipo de Cuenta
                                                </label>
                                                <input id="account_type" name="account_type" type="text" wire:key="account_type" wire:model.debounce.500ms="account_type"
                                                       class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                @error('account_type')
                                                <div class="text-red-500 text-xs">
                                                    {{ $errors->first('account_type') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="account_number"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Numero de cuenta
                                                    </label>
                                                    <input id="account_number" name="account_number" type="text" wire:key="account_number" wire:model.debounce.500ms="account_number"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('account_number')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('account_number') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                            <div class="mb-4">
                                                <label for="branchOffice"
                                                       class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                    Sucursal de Caja Chica
                                                </label>

                                                <x-simple-select
                                                    name="branchOffice"
                                                    id="branchOffice"
                                                    wire:model="branchOffice"
                                                    :options="$branchOffices"
                                                    value-field='ID'
                                                    text-field='Sucursal'
                                                    placeholder="Seleccione ..."
                                                    search-input-placeholder="Buscar Sucursal"
                                                    :searchable="true"
                                                    class="form-select"
                                                    no-result="No se encontraron coincidencias"
                                                    no-options="No hay datos"
                                                />
                                                @error('branchOffice')
                                                <div class="text-red-500 text-size-xs">
                                                    {{ $errors->first('branchOffice') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                            <div class="mb-4">
                                                <span>
                                                    <strong>
                                                        TOTAL : {{ number_format( $total_cash_provisional , 0, '', '.') }}
                                                    </strong>
                                                </span>
                                            </div>
                                        </div>

                                        {{--<button wire:loading.attr="disabled" wire:loading.class="!cursor-wait" type="button" class="outline-none inline-flex justify-center items-center group transition-all ease-in duration-150 focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed rounded gap-x-2 text-sm px-4 py-2     ring-primary-500 text-white bg-primary-500 hover:bg-primary-600 hover:ring-primary-600
    dark:ring-offset-slate-800 dark:bg-primary-700 dark:ring-primary-700
    dark:hover:bg-primary-600 dark:hover:ring-primary-600" onclick="$openModal('cardModal')">
                                            Open
                                        </button>
                                        <x-modal.card title="Edit Customer" blur wire:model.defer="cardModal">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <x-input label="Name" placeholder="Your full name" />
                                                <x-input label="Phone" placeholder="USA phone" />

                                                <div class="col-span-1 sm:col-span-2">
                                                    <x-input label="Email" placeholder="example@mail.com" />
                                                </div>

                                                <div class="col-span-1 sm:col-span-2 cursor-pointer bg-gray-100 rounded-xl shadow-md h-72 flex items-center justify-center">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <x-icon name="cloud-upload" class="w-16 h-16 text-blue-600" />
                                                        <p class="text-blue-600">Click or drop files here</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <x-slot name="footer">
                                                <div class="flex justify-between gap-x-4">
                                                    <x-button flat negative label="Delete" wire:click="delete" />

                                                    <div class="flex">
                                                        <x-button flat label="Cancel" x-on:click="close" />
                                                        <x-button primary label="Save" wire:click="save" />
                                                    </div>
                                                </div>
                                            </x-slot>
                                        </x-modal.card>--}}

                                        <form wire:submit.prevent="submit">
                                            <div class="flex flex-wrap ">
                                                <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                                        <thead class="align-bottom">
                                                            <tr>
                                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                                    N° Doc.
                                                                </th>
                                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                                    Fecha
                                                                </th>
                                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                                Tipo Doc.
                                                                </th>
                                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                                    Proveedor
                                                                </th>
                                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                                    Detalle
                                                                </th>
                                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                                    Valor Doc.
                                                                </th>
                                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                                    Archivo
                                                                </th>
                                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                                    Cuenta
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody x-data="{}">
                                                            <tr>
                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input wire:model.defer="detail.0.document" type="number" min="1" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></input>
                                                                    @error('detail.0.document') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input type="date" wire:model.defer="detail.0.date"
                                                                           class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                                    >
                                                                    @error('detail.0.date') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 leading-normal align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                                                    <select
                                                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                                        wire:model.defer="detail.0.type">
                                                                        <option value="">Seleccione ...</option>
                                                                        @foreach ($documents as $key => $document)
                                                                            <option value="{{ $key }}">{{ $document }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('detail.0.type') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input wire:model.defer="detail.0.provider" type="text" placeholder="" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></input>
                                                                    @error('detail.0.provider') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input wire:model.defer="detail.0.description" type="text" placeholder="" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></input>
                                                                    @error('detail.0.description') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input x-mask:dynamic="$money($input, ',')" wire:model.lazy="detail.0.amount" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                                    @error('detail.0.amount')
                                                                    <span class="text-red-500 text-xs">
                                                                        {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input wire:model.defer="detail.0.file" type="file" placeholder="" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                                    @error('detail.0.file') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <select
                                                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                                        wire:model.defer="detail.0.account">
                                                                        <option value="">Seleccione ...</option>
                                                                        @foreach ($accounts as $key => $account)
                                                                            <option value="{{ $account['id'] }}">{{ $account['number_account'] }} {{ $account['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('detail.0.account') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <button wire:click.prevent="add( {{ $i }} )"
                                                                            class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-green-500 leading-normal text-xs tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md"
                                                                    >
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>

                                                            @foreach($inputs as $key => $value)
                                                            <tr>
                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input wire:model.defer="detail.{{ $value }}.document" type="number" placeholder="" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></input>
                                                                    @error("detail.". $value .".document") <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input type="date" wire:model.defer="detail.{{ $value }}.date"
                                                                           class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                                    >
                                                                    @error("detail.". $value .".date") <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                                                    <select
                                                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                                        wire:model.defer="detail.{{ $value }}.type">
                                                                        <option value="">Seleccione ...</option>
                                                                        @foreach ($documents as $x => $document)
                                                                            <option value="{{ $x }}">{{ $document }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error("detail.". $value .".type") <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input wire:model.defer="detail.{{ $value }}.provider" type="text" placeholder="" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></input>
                                                                    @error("detail.". $value .".provider") <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input wire:model.defer="detail.{{ $value }}.description" type="text" placeholder="" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></input>
                                                                    @error("detail.". $value .".description") <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input x-mask:dynamic="$money($input, ',')" wire:model.lazy="detail.{{ $value }}.amount" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                                    @error("detail.". $value .".amount") <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <input wire:model.lazy="detail.{{ $value }}.file" type="file" placeholder="" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                                    @error("detail.". $value .".file") <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <select
                                                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                                        wire:model.defer="detail.{{ $value }}.account">
                                                                        <option value="">Seleccione ...</option>
                                                                        @foreach ($accounts as $y => $account)
                                                                            <option value="{{ $account['id'] }}">{{ $account['number_account'] }} {{ $account['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error("detail.". $value .".account") <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                                                                </td>

                                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                                    <button wire:click.prevent="remove( {{ $key }}, {{ $value }} )"
                                                                            class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-red-500 leading-normal text-xs tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md"
                                                                    >
                                                                        <i class="fas fa fa-minus"></i>
                                                                    </button>
                                                                </td>

                                                            </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
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
                                            <button type="button" wire:click.prevent="store()"
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

</div>
