<div class="grid grid-cols-12 gap-y-2">

    @if( $author === 'user' )

    <div class="col-start-1 col-end-8 p-3 rounded-lg">
        <div class="flex flex-row items-center">
            <div
                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0"
            >
                {{ Str::substr( $client, 0,1 ) }}
            </div>
            <div
                class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl"
            >
                <div>
                    @if( $type === 'text')
                        {{ $message['body'] }}

                    @elseif( $type === 'card_template')
                        {{ $message['title'] }}<br>
                        {{ $message['body'] }}

                    @elseif( $type === 'button')
                        {{ $message['body'] }}

                    @elseif( $type === 'image')
                        <strong>Imagen subida, ver adjuntos</strong>
                    @elseif( $type === 'whatsapp_list')
                        {{ $message['body']['text'] }}
                        {{ $message['header']['text'] }}
                        {{ $message['footer']['text'] }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    @elseif( $author === 'bot' || $author === 'agent' )

    <div class="col-start-6 col-end-13 p-3 rounded-lg">
        <div class="flex items-center justify-start flex-row-reverse">
            <div
                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0"
            >
                P
            </div>
            <div
                class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl"
            >
                <div>
                    @if( $type === 'text')
                        {{ $message['body'] }}
                    @elseif( $type === 'card_template')
                        {{ $message['title'] }}<br>
                        {{ $message['body'] }}
                    @elseif( $type === 'button')
                        {{ $message['body'] }}
                    @elseif( $type === 'whatsapp_list')
                        {{ $message['body']['text'] }}
                        {{ $message['header']['text'] }}
                        {{ $message['footer']['text'] }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endif
</div>
