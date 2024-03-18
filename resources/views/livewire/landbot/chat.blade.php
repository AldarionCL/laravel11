<div>
    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header', 'Landbot - Lead Asignados') </p>
                            </div>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="p-0 overflow-x-auto">
                                <div class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Landbot</p>
                                    <div class="flex h-screen antialiased text-gray-800">
                                        <div class="flex flex-row h-full w-full overflow-x-hidden">
                                            <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">

                                                <div class="flex flex-col mt-8">
                                                    Archivos Adjuntos
                                                    <div
                                                        class="flex flex-col space-y-1 mt-4 -mx-2 h-48 overflow-y-auto">
                                                        @foreach( $conversation->messages as $message )
                                                            @if( $message->file === 1 )
                                                                @foreach( $message->message as $detail )
                                                                    @if( $detail['type'] === 'image' || $detail['type'] === 'document' )
                                                                        <a href="{{ $detail['data']['url'] }}"
                                                                           target="_blank">
                                                                            <i class="fa fa-file-text-o fa-3x"
                                                                               aria-hidden="true"></i>
                                                                        </a>
                                                                    @elseif( $detail['type'] === 'audio')
                                                                        <audio controls>
                                                                            <source src="{{ $detail['data']['url'] }}" type="audio/ogg">
                                                                            Your browser does not support the audio element.
                                                                        </audio>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach

                                                    </div>

                                                </div>
                                            </div>
                                            {{-- /////////////////////////////////////////////////// --}}
                                            {{-- Aca comienza el renderizado del mensaje de Whatsapp --}}

                                            <div class="flex flex-col flex-auto h-full p-6">
                                                <div
                                                    class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4"
                                                >
                                                    <div class="flex flex-col h-full overflow-x-auto mb-4">
                                                        <div class="flex flex-col h-full">

                                                            @foreach($conversation->messages as $data )
                                                                @foreach( $data->message as $detail )

                                                                    <x-message
                                                                        :author="$data->author_type"
                                                                        :client="$detail['customer']['name']"
                                                                        :message="$detail['data']"
                                                                        :type="$detail['type']"
                                                                    />

                                                                @endforeach

                                                            @endforeach

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4"
                                                    >
                                                        {{--<div>
                                                            <button
                                                                class="flex items-center justify-center text-gray-400 hover:text-gray-600"
                                                            >
                                                                <svg
                                                                    class="w-5 h-5"
                                                                    fill="none"
                                                                    stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                                                                    ></path>
                                                                </svg>
                                                            </button>
                                                        </div>--}}
                                                        <div class="flex-grow ml-4">
                                                            <div class="relative w-full">
                                                                <input
                                                                    wire:model="message"
                                                                    type="text"
                                                                    class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10"
                                                                />
                                                                {{--<button
                                                                    class="absolute flex items-center justify-center h-full w-12 right-0 top-0 text-gray-400 hover:text-gray-600"
                                                                >
                                                                    <svg
                                                                        class="w-6 h-6"
                                                                        fill="none"
                                                                        stroke="currentColor"
                                                                        viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                    >
                                                                        <path
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                        ></path>
                                                                    </svg>
                                                                </button>--}}
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <button
                                                                wire:click="send({{ $conversation->customer_id  }})"
                                                                class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0"
                                                            >
                                                                <span>Enviar</span>
                                                                <span class="ml-2">
                  <svg
                      class="w-4 h-4 transform rotate-45 -mt-px"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                    ></path>
                  </svg>
                </span>
                                                            </button>
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
            </div>
        </div>
    </div>
</div>
