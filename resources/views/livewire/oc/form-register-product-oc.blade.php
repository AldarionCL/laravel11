<div>
    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header', 'Home') </p>
                            </div>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="p-0 overflow-x-auto">
                                <div
                                    class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                        Registro de Articulos
                                    </p>
                                    <form wire:submit.prevent="submit">
                                        <div class="flex flex-wrap">

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="category"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Categoría</label>
                                                    {{--<select name="category" wire:model="category"
                                                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                        <option value="">Seleccione...</option>
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>--}}

                                                    <x-simple-select
                                                        tabindex="1"
                                                        name="category"
                                                        id="category"
                                                        wire:model="category"
                                                        :options="$categories"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione..."
                                                        search-input-placeholder="Buscar Categoria"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                        no-result="No hay resultados"
                                                    />

                                                    @error('category')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('category') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="subCategory"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Sub Categoría
                                                    </label>
                                                    {{--<select name="subCategory" wire:model="product.ocSubCategory_id"
                                                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                        <option value="">Seleccione...</option>
                                                        @foreach($subCategories as $subCategory)
                                                            <option
                                                                value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                        @endforeach
                                                    </select>--}}

                                                    <x-simple-select
                                                        name="subCategory"
                                                        id="subCategory"
                                                        wire:model="product.ocSubCategory_id"
                                                        :options="$subCategories"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione..."
                                                        search-input-placeholder="Buscar Sub Categoria"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                        no-result="No hay resultados"
                                                    />

                                                    @error('product.ocSubCategory_id')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('product.ocSubCategory_id') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="title" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Articulo
                                                    </label>
                                                    <input type="text" name="product" wire:model.debounce.500ms="product.name"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('product.name')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('product.name') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="costCenter"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Centro de Costo
                                                    </label>

                                                    <x-simple-select
                                                        name="costCenter"
                                                        id="costCenter"
                                                        wire:model="product.costCenter_id"
                                                        :options="$branchOffice"
                                                        value-field='ID'
                                                        text-field='Sucursal'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Centro de Costo"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('product.costCenter_id')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('product.costCenter_id') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="measure"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Unidad de Medida
                                                    </label>
                                                    <select name="measure" wire:model="product.measure_id"
                                                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                        <option value="">Seleccione...</option>
                                                        @foreach($measures as $measure)
                                                            <option
                                                                value="{{ $measure->id }}">{{ $measure->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('product.measure_id')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('product.measure_id') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="currency"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Tipo de Moneda
                                                    </label>
                                                    <select name="currency" wire:model="product.currency_id"
                                                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                                        <option value="">Seleccione...</option>
                                                        @foreach($currencies as $currency)
                                                            <option
                                                                value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('product.currency_id')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('product.currency_id') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="account"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Cuenta
                                                    </label>

                                                    <x-simple-select
                                                        name="account"
                                                        id="account"
                                                        wire:model="product.AccountID"
                                                        :options="$accounts"
                                                        value-field='ID'
                                                        text-field='name'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Cuenta"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('product.AccountID')
                                                    <div class="text-red-500 text-xs">
                                                        {{ $errors->first('product.AccountID') }}
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header', 'Home') </p>
                            </div>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="p-0 overflow-x-auto">
                                <div
                                    class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                        Listado de Articulos
                                    </p>
                                        <div class="flex flex-wrap">
                                            <livewire:oc.product-list-table />
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

