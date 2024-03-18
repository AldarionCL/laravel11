<div class="flex flex-row gap-0 overflow-auto">
    <div class="xs:w-1/2 sm:w-1/2 lg:w-1/4  m-2 relative min-w-25 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p class="mb-0 font-sans font-semibold leading-normal uppercase text-size-sm">Vehículos en Cpd<br>&nbsp;</p>
                        <h5 class="mb-2 font-bold" >{{$vehiculosCpd}}</h5>

                    </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-orange-500">
                        <i class="fa fa-hourglass-start  text-size-lg relative top-3.5 text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="xs:w-1/2 sm:w-1/2 lg:w-1/4 m-2 relative flex flex-col min-w-25 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p class="mb-0 font-sans font-semibold leading-normal uppercase text-size-sm">Vehículos en WIP<br>&nbsp;</p>
                        <h5 class="mb-2 font-bold">{{$vehiculosTaller}}</h5>

                    </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-500 to-orange-500">
                        <i class="fa fa-sign-out text-size-lg relative top-3.5 text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="xs:w-1/2 sm:w-1/2 lg:w-1/4 m-2 relative flex flex-col min-w-25 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p class="mb-0 font-sans font-semibold leading-normal uppercase text-size-sm">Vehículos ingresados <br><small>Mes actual</small></p>
                        <h5 class="mb-2 font-bold" >{{$vehiculosIngresados}}</h5>

                    </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-cyan-500">
                        <i class="fa fa-list text-size-lg relative top-3.5 text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="xs:w-1/2 sm:w-1/2 lg:w-1/4 m-2 relative flex flex-col min-w-25 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p class="mb-0 font-sans font-semibold leading-normal uppercase text-size-sm">Vehículos terminados <br><small>Mes actual</p>
                        <h5 class="mb-2 font-bold" >{{$vehiculosTerminados}}</h5>

                    </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-cyan-500">
                        <i class="fa fa-list text-size-lg relative top-3.5 text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

