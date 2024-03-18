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
                                        Información General
                                    </p>

                                    <div class="flex-auto pt-6">
                                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                            <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850">
                                                <div class="flex flex-col">
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">ID : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->ID }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Nombre : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->Nombre }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">RUN : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->Rut }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Email : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->Email }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Perfil : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->profile->Perfil }}</span></span>
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Cargo : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->position->Cargo }}</span></span>
                                                </div>
                                                <div class="flex flex-col ml-auto text-right">
                                                    <span class="mb-2 leading-tight text-size-xs dark:text-white/80">Telefono Oficina : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->TelefonoOficina }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Celular : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->Celular }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Disponible : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->Disponible === 1 ? 'SI' : 'NO' }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Activo : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $user->Activo === 1 ? 'SI' : 'NO' }}</span></span>
                                                    <span class="leading-tight text-size-xs dark:text-white/80">Financiera Asociada : <span
                                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">SIN INFO</span></span>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="flex-none w-full max-w-full">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                                <div class="flex items-center">
                                    <p class="mb-0 dark:text-white/80">@yield('title-header', 'Permisos') </p>
                                </div>
                            </div>
                            <div class="flex-auto p-6">
                                <div class="p-0 overflow-x-auto">
                                    <div class="mb-4">
                                        <label for="bank"
                                               class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">
                                            Roles
                                        </label>
                                        <x-simple-select
                                            name="roles"
                                            id="roles"
                                            wire:model="rol"
                                            :options="$roles"
                                            value-field='id'
                                            text-field='name'
                                            placeholder="Seleccione ..."
                                            search-input-placeholder="Buscar Rol"
                                            :searchable="true"
                                            class="form-select"
                                            no-options="No hay datos"
                                        />
                                        @error('roles')
                                        <div class="text-red-500 text-xs">
                                            {{ $errors->first('roles') }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                        <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Listado de Permisos</p>

                                        <form wire:submit.prevent="submit">
                                            @php
                                                $title = '';
                                            @endphp
                                            @foreach($permissions as $key => $permission)
                                                @php
                                                if ($title == ''){
                                                    if ($title != $permission['group']){
                                                        $title = $title != $permission['group'] ? $permission['group'] :  $title;
                                                        echo '<label for="remember" class="inline-block mb-0 ml-0 mt-4 font-normal cursor-pointer select-none text-sm text-slate-700"><strong>'.$title.'</strong></label>';
                                                    }
                                                }else{
                                                    if ($title != $permission['group']){
                                                        $title = $title != $permission['group'] ? $permission['group'] :  $title;
                                                        echo '<label for="remember" class="inline-block mb-0 ml-0 mt-4 font-normal cursor-pointer select-none text-sm text-slate-700"><strong>'.$title.'</strong></label>';
                                                    }
                                                }
                                                @endphp
                                                <div class="min-h-6 mb-0.5 flex items-center">
                                                    <input wire:model="hasPermission" value="{{ $permission['name'] }}" {{ $user->hasPermissionTo($permission['name']) ? 'checked' : ''  }}  id="permission" class="ml-1 rounded-10 duration-300 ease-in-out after:rounded-circle after:shadow-2xl after:duration-300 checked:after:translate-x-5.3 h-5 mt-0.5 relative float-left w-10 cursor-pointer appearance-none border border-solid border-blue-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" checked />
                                                    <label for="permission" class="inline-block pl-3 mb-0 ml-0 font-normal cursor-pointer select-none text-sm text-slate-700">{{ $permission['name'] }}</label>
                                                </div>
                                            @endforeach

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
                                                        class="inline-block mt-6 px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
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

