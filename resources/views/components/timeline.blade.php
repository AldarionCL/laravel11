<div class="container mx-auto w-full h-full">
    <div class="relative wrap overflow-hidden p-2 h-full">
        <div class="border-2-2 absolute border-opacity-20 border-gray-700 h-full border" style="left: 50%"></div>

        <!-- right timeline -->
        <div class="mb-1 flex justify-between items-center w-full right-timeline">
            <div class="order-1 w-5/12"></div>
            <div class="z-20 flex items-center order-1 bg-gray-800 shadow-xl w-8 h-8 rounded-full">
                <h1 class="mx-auto mt-2 font-semibold text-lg text-white">1</h1>
            </div>
            <div class="order-1 bg-blue-500 rounded-lg shadow-xl w-5/12 px-6 py-1">
                <h3 class="mb-1 font-bold text-white text-sm ">Ingresado por:</h3>
                <p class="text-sm leading-snug tracking-wide text-white text-opacity-100">
                    {{ $operation->user->Nombre }}
                </p>
            </div>
        </div>
        @php
            $date = $approvals[0]->updated_at->format('d-m-Y H:i');
            $index = $approvals->where('state', 1)->value('id');
        @endphp

        @foreach($approvals as $key => $value)
            @if( $value->active === 0 )

                @if( $key % 2 == 0 )

                    <!-- left timeline -->
                    <div class="mb-1 flex justify-between flex-row-reverse items-center w-full left-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-xl w-8 h-8 rounded-full">
                            <h1 class="mx-auto mt-2 text-white font-semibold text-lg">{{ $key + 2 }}</h1>
                        </div>
                        <div class="order-1 {{ $value->id === $index ? 'bg-orange-500' : ( $value->id < $index ? 'bg-green-500 ' : 'bg-slate-500' ) }} rounded-lg shadow-xl w-5/12 px-6 py-1">
                            <h3 class="mb-1 font-bold text-white text-sm">Aprobador {{ $key + 1 }}</h3>
                            <div class="text-sm leading-snug tracking-wide text-white text-opacity-100">
                                {{ $value->user->Nombre }}
                            </div>
                            <div class="text-sm leading-snug tracking-wide text-white text-opacity-100">
                                {{ $date === $value->updated_at->format('d-m-Y H:i') && $key === 0 ?  $value->updated_at->format('d-m-Y H:i') : '' }}
                            </div>
                        </div>
                    </div>
                @else

                    <!-- right timeline -->
                    <div class="mb-1 flex justify-between items-center w-full right-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-xl w-8 h-8 rounded-full">
                            <h1 class="mx-auto mt-2 font-semibold text-lg text-white">{{ $key + 2 }}</h1>
                        </div>
                        <div class="order-1 {{ $value->id === $index ? 'bg-orange-500' : ( $value->id < $index ? 'bg-green-500 ' : 'bg-slate-500' ) }} rounded-lg shadow-xl w-5/12 px-6 py-1">
                            <h3 class="mb-1 font-bold text-white text-sm ">Aprobador {{ $key + 1 }}</h3>
                            <div class="text-sm leading-snug tracking-wide text-white text-opacity-100">
                                {{ $value->user->Nombre }}
                            </div>
                            <div class="text-sm leading-snug tracking-wide text-white text-opacity-100">
                                {{ $date != $value->updated_at->format('d-m-Y H:i') ? $value->updated_at->format('d-m-Y H:i') : '' }}
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach

    </div>
</div>
