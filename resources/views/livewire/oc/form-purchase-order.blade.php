<div>
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header',  "Orden de Compra" ) </p>
                                <a href="{{ route( 'order.request.list.aprroved') }}"
                                   class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                    <i class="fas fa-list" aria-hidden="true"></i>
                                    Solicitud de Compras
                                </a>

                                @if( config('app.env') === 'local')
                                    <a href="{{ route( 'list.pre.purchase.order.provider') }}"
                                       class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                        <i class="fas fa-list" aria-hidden="true"></i>
                                        OC de Proveedores
                                    </a>
                                @endif

                                <button wire:click="createProduct"
                                        class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
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
                                        Formulario Registro de Orden de Compra
                                    </p>
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
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Empresa"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('management')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('management') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="management"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Marca - Gerencia
                                                    </label>

                                                    <x-simple-select
                                                        name="management"
                                                        id="management"
                                                        wire:model="management"
                                                        :options="$brands"
                                                        value-field='ID'
                                                        text-field='Gerencia'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Marca - Gerencia"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('management')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('management') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
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
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Area"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('area')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('area') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="office"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Sucursal - Taller - Departamento
                                                    </label>

                                                    <x-simple-select
                                                        name="office"
                                                        id="office"
                                                        wire:model="office"
                                                        :options="$branches"
                                                        value-field='ID'
                                                        text-field='Sucursal'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Sucursal"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('office')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('office') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="provider"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Proveedor
                                                    </label>

                                                    <x-simple-select
                                                        name="provider"
                                                        id="provider"
                                                        wire:model="provider"
                                                        :options="$providers"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Proveedor"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('provider')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('provider') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="condition"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Condiciones de Pago
                                                    </label>

                                                    <x-simple-select
                                                        name="condition"
                                                        id="condition"
                                                        wire:model="condition"
                                                        :options="$conditions"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Condición"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />

                                                    @error('condition')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('condition') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="address"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Dirección de entrega
                                                    </label>


                                                            <input type="text" id="address" name="address" wire:key="address"
                                                                   wire:model.debounce.500ms="address"
                                                                   class=" focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                      |                      @error('address')
                                                            <div class="text-red-500 text-size-xs">
                                                                {{ $errors->first('address') }}
                                                            </div>
                                                            @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="commune"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Comuna
                                                    </label>

                                                    <x-simple-select
                                                        name="commune"
                                                        id="commune"
                                                        wire:model="commune"
                                                        :options="$communes"
                                                        value-field='ID'
                                                        text-field='Comuna'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Comuna"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />

                                                    @error('commune')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('commune') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="contact"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Contacto
                                                    </label>

                                                    <x-simple-select
                                                        name="contact"
                                                        id="contact"
                                                        wire:model="contact"
                                                        :options="$contacts"
                                                        value-field='ID'
                                                        text-field='Nombre'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Contacto"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />

                                                    @error('contact')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('contact') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="condition"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Distribución de gastos
                                                    </label>


                                                    <input type="text" name="comment" wire:key="comment"
                                                           wire:model.debounce.500ms="comment"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('comment')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('comment') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="file"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Adjuntar cotización
                                                    </label>


                                                    <input type="file" wire:model="files" multiple
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('files.*')
                                                        <div class="text-red-500 text-xs">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="file"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Cotizaciones Solicitud de Compra
                                                    </label>
                                                    @if( $filesSP !== null )
                                                        @foreach($filesSP as $file)
                                                            <a href="{{ Storage::url( $file['url'] ) }}"
                                                               target="_blank">
                                                                <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                        </div>


                                        <div class="grid  grid-cols-4">

                                            <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="product"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Articulo
                                                    </label>

                                                    <x-simple-select
                                                        name="product"
                                                        id="product"
                                                        wire:model.debounce.defer="product"
                                                        :options="$products"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Producto"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('product')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('product') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

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
                                                    <label for="unit"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Valor Unitario
                                                    </label>
                                                    <input type="text" name="unit" wire:key="unit"
                                                           wire:model.debounce.defer="unit"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('unit')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('unit') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="product"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Impuesto
                                                    </label>

                                                    <x-simple-select
                                                        name="taxe"
                                                        id="taxe"
                                                        wire:model.defer="taxe"
                                                        :options="$taxes"
                                                        value-field='id'
                                                        text-field='name'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Impuesto"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('taxe')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('taxe') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="grid  grid-cols-4">
                                            <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="description"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Descripción
                                                    </label>
                                                    <input type="text" name="description" wire:key="description"
                                                           wire:model.debounce.defer="description"
                                                           class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"/>
                                                    @error('description')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('description') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="center"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Area de Negocio
                                                    </label>
                                                    <x-simple-select
                                                        name="zone"
                                                        id="zone"
                                                        wire:model="zone"
                                                        :options="$zones"
                                                        value-field='ID'
                                                        text-field='TipoSucursal'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Area de Negocio"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('zone')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('zone') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="center"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Sucursal
                                                    </label>
                                                    <x-simple-select
                                                        name="center"
                                                        id="center"
                                                        wire:model.defer="center"
                                                        :options="$centers"
                                                        value-field='ID'
                                                        text-field='Sucursal'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Centro de Costo"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('center')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('center') }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="center"
                                                           class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                                        Sección
                                                    </label>
                                                    <x-simple-select
                                                        name="section"
                                                        id="section"
                                                        wire:model.defer="section"
                                                        :options="$sections"
                                                        value-field='ID'
                                                        text-field='Seccion'
                                                        placeholder="Seleccione ..."
                                                        search-input-placeholder="Buscar Sección"
                                                        :searchable="true"
                                                        class="form-select"
                                                        no-options="No hay datos"
                                                    />
                                                    @error('section')
                                                    <div class="text-red-500 text-size-xs">
                                                        {{ $errors->first('section') }}
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
                                        <button wire:click="remove"
                                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-500 to-red-600 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                            Anular
                                        </button>
                                        <button type="submit"
                                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                                            Enviar
                                        </button>
                                    </form>
                                    <div class="flex flex-wrap pt-6 pb-3">
                                        TOTAL : <strong>$ {{ number_format( $total , 0, '', '.') }} </strong>
                                        <table
                                            class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                            <thead class="align-bottom">
                                            <tr>
                                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    Indice
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
                                                    Area
                                                </th>
                                                <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    C. Costo
                                                </th>
                                                <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    Seccion
                                                </th>
                                                <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    Presupuesto
                                                </th>
                                                <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                    Saldo
                                                </th>

                                                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap"></th>
                                            </tr>
                                            </thead>
                                            <tbody class="border-t">

                                            @if($arrayProduct !== null)
                                                @foreach( $arrayProduct as $key => $item)
                                                    <tr>
                                                        <td class="text-xs p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            {{ $key + 1 }}
                                                        </td>
                                                        <td class="text-xs p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            {{ $item['sku'] }}
                                                        </td>
                                                        <td class="text-xs p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            {{ $item['product'] }}
                                                        </td>
                                                        <td class="text-xs p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <input name="descriptionDetail" type="text" value="{{ $item['description'] }}" wire:keydown.enter="modify({{ $key }}, $event.target.value, $event.target.name )">
                                                        </td>
                                                        <td class="text-xs p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center">
                                                                <input name="amountDetail" min="1" type="number" value="{{ $item['amount'] }}" wire:keydown.enter="modify({{ $key }}, $event.target.value, $event.target.name )">
                                                            </div>
                                                        </td>

                                                        <td class="text-xs p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center">
                                                                <input name="unitDetail" min="1" type="number" value="{{ $item['unit'] }}" wire:keydown.enter="modify({{ $key }}, $event.target.value, $event.target.name )">
                                                            </div>
                                                        </td>
                                                        <td class="text-xs p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center">
                                                                $ {{ number_format( $item['total'] , 0, '', '.') }}
                                                            </div>
                                                        </td>
                                                        <td class="text-xs p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            @if( $pre )
                                                                <x-simple-select
                                                                    on-select="selected"
                                                                    value="{{ $item['idZone'] }}"
                                                                    name="detail.{{ $key }}"
                                                                    id="idTypeBranchDetail"
                                                                    :options="$businessAreasPre"
                                                                    value-field='ID'
                                                                    text-field='TipoSucursal'
                                                                    placeholder="Seleccione ..."
                                                                    search-input-placeholder="Buscar Centro de Costo"
                                                                    :searchable="true"
                                                                    class="form-select"
                                                                    no-options="No hay datos"
                                                                />
                                                            @else
                                                                {{ $item['zone'] }} }}
                                                            @endif
                                                        </td>
                                                        <td class="text-xs p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center">
                                                                @if( $pre )
                                                                    <x-simple-select
                                                                        on-select="selected"
                                                                        value="{{ $item['idCenter'] }}"
                                                                        name="detail.{{ $key }}"
                                                                        id="idCenterDetail"
                                                                        :options="$centersPre"
                                                                        value-field='ID'
                                                                        text-field='Sucursal'
                                                                        placeholder="Seleccione ..."
                                                                        search-input-placeholder="Buscar Centro de Costo"
                                                                        :searchable="true"
                                                                        class="form-select"
                                                                        no-options="No hay datos"
                                                                    />
                                                                @else
                                                                    {{ $item['center'] }}
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="text-xs p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            @if( $pre )
                                                                <x-sections :key="$key" :sectionsPre="$sectionsPre" :item="$item['idSection'] ?? '' " :zone="$item['idZone']"/>
                                                            @else
                                                                {{ $item['section'] }}
                                                            @endif
                                                        </td>
                                                        <td class="text-xs p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div class="flex items-center justify-center">
                                                                $ {{ number_format( $item['budget'] , 0, '', '.') }}
                                                            </div>
                                                        </td>

                                                        <td class="text-xs p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                            <div
                                                                class="flex items-center justify-center {{ $item['balance'] >= 0 ? '' : 'text-red-600' }}">
                                                                $ {{ number_format( $item['balance'] , 0, '', '.') }}
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
