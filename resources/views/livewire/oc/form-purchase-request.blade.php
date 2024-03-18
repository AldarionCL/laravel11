<div>
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header',  "SOLICITUD DE COMPRA" ) </p>

                                    <button wire:click="createProduct" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                        <i class="fas fa-plus"></i>
                                        Solicitud creación de Articulo
                                    </button>

                            </div>

                        </div>
                        <div class="flex-auto p-6">
                            <div class="p-0 overflow-x-auto">
                                <div
                                    class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                        Formulario Registro de SOLICITUD DE COMPRA</p>

                                    <form wire:submit.prevent="submit">
                                        <div class="flex flex-wrap ">
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="business"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Empresa
                                                    </label>
                                                    <x-simple-select
                                                        name="business"
                                                        id="business"
                                                        wire:model="business"
                                                        :options="$businesses"
                                                        value-field='ID'
                                                        text-field='Empresa'
                                                        placeholder="Seleccione..."
                                                        search-input-placeholder="Buscar Empresa"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                        no-result="No hay resultados"
                                                    />
                                                    @error('business')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('business') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="brand"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Marca - Gerencia
                                                    </label>
                                                    <x-simple-select
                                                        name="brand"
                                                        id="brand"
                                                        wire:model="brand"
                                                        :options="$brands"
                                                        value-field='ID'
                                                        text-field='Gerencia'
                                                        placeholder="Seleccione..."
                                                        search-input-placeholder="Buscar Marca"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                        no-result="No hay resultados"
                                                    />
                                                    @error('brand')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('brand') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="area"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Area de Negocio
                                                    </label>
                                                    <x-simple-select
                                                        name="area"
                                                        id="area"
                                                        wire:model="area"
                                                        :options="$businessAreas"
                                                        value-field='ID'
                                                        text-field='TipoSucursal'
                                                        placeholder="Seleccione..."
                                                        search-input-placeholder="Buscar Area"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                        no-result="No hay resultados"
                                                    />
                                                    @error('area')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('area') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="branch"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Sucursal - Taller - Departamento
                                                    </label>
                                                    <x-simple-select
                                                        name="branch"
                                                        id="branch"
                                                        wire:model="branch"
                                                        :options="$branches"
                                                        value-field='ID'
                                                        text-field='Sucursal'
                                                        placeholder="Seleccione..."
                                                        search-input-placeholder="Buscar Sucursal"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                        no-result="No hay resultados"
                                                    />
                                                    @error('branch')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('branch') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="branch"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Sección
                                                    </label>
                                                    <x-simple-select
                                                        name="section"
                                                        id="section"
                                                        wire:model="section"
                                                        :options="$sections"
                                                        value-field='ID'
                                                        text-field='Seccion'
                                                        placeholder="Seleccione..."
                                                        search-input-placeholder="Buscar Sección"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                        no-result="No hay resultados"
                                                    />
                                                    @error('section')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('section') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>


                                        <div class="">
                                            <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="products"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Articulo
                                                    </label>
                                                    <x-simple-select
                                                        name="product"
                                                        id="product"
                                                        wire:model="product"
                                                        :options="$products"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione..."
                                                        search-input-placeholder="Buscar Producto"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                        no-result="No hay resultados"
                                                    />
                                                    @error('product')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('product') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="grid  grid-cols-3 ">


                                            <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="amount"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Cantidad
                                                    </label>
                                                    <input type="text" name="amount" wire:key="amount"
                                                           wire:model.debounce.500ms="amount"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('amount')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('amount') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                                <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                    <div class="mb-4">
                                                        <label for="description"
                                                               class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                            Descripción
                                                        </label>
                                                        <input type="text" name="description" wire:key="description"
                                                               wire:model.debounce.500ms="description"
                                                               class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                        @error('description')
                                                        <div class="text-red-500 text-size-xs">
                                                            {{ $errors->first('description') }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>


                                            <button wire:click.prevent="add"
                                                    class="h-8 mt-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                                                Añadir
                                            </button>
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
                                        <button wire:click.prevent="remove"
                                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-500 to-red-600 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                            Anular
                                        </button>
                                        <button type="submit"
                                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                            Enviar
                                        </button>

                                        <button type="button" wire:click.prevent="submitMultiple"
                                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                            Enviar Múltiple
                                        </button>
                                    </form>
                                    <div class="flex flex-wrap pt-6 pb-3">
                                        <table
                                            class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                            <thead class="align-bottom">
                                            <tr>
                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    Item
                                                </th>
                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    Codigo
                                                </th>
                                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    Articulo
                                                </th>
                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    Descripción
                                                </th>
                                                <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    Cantidad
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="border-t">

                                            @if($arrayProduct !== null)
                                                @foreach( $arrayProduct as $key => $item)
                                                    <tr>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            {{ $key + 1 }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            {{ $item['sku'] }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            {{ $item['product'] }}
                                                        </td>
                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <input type="text" value="{{ $item['description'] }}" wire:keydown.enter="modify({{ $key }}, $event.target.value )">

                                                        </td>
                                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center">
                                                                {{ $item['amount'] }}
                                                            </div>
                                                        </td>

                                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <x-button-minus-plus :id="$key"/>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
