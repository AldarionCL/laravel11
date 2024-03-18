<form id="formLog" name="formLog"  method="get" action="{{route('creaLogTDRIVE',[$idTdrive])}}"
class="p-3">
    <input type="hidden" name="idTarea" id="idTarea" value="">
    <ul class="w-100 text-xs font-mediartinez Sotoum text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600 bg-gray-300"><span class="fa fa-user text-xs"> </span> Registro Log del flujo</li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600" style="z-index: 99">
           Registro de acciones realizadas en el flujo.
        </li>
        <li style="max-height: 300px; overflow: scroll;">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                <tr>
                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Log</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Creado por</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tdrivelogs as $tdrivelog)
                    <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="mb-0 leading-tight text-xs text-slate-400 text-xs"  style="white-space: pre-wrap"><span class="pl-2 fa {{($tdrivelog->Tipo == 'COMENTARIO')?'fa-comment-o text-green-700': (($tdrivelog->Tipo == 'ERROR')?'fa-times-circle text-red-700':'fa-info-circle text-sky-700')}}"> </span> {{$tdrivelog->textolog}}</div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <p class="mb-0 font-semibold leading-tight text-xs" >{{$tdrivelog->Usuario->Email}}</p>
                            <p class="mb-0 leading-tight text-xs text-slate-400">({{$tdrivelog->created_at}})</p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">
            <p>Crear nuevo registro de log personalizado:</p>
            <textarea required name="textolog" rows="3" placeholder="escriba su comentario...." class="focus:shadow-primary-outline min-h-unset text-sm leading-5.6 ease block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></textarea>
            <div class="flex flex-wrap w-full">
                <div class="p-2 w-full">
                    <button type="submit" id="botonLog" class="inline-block px-6 py-3 mr-3 font-bold text-center text-blue-500 uppercase align-middle transition-all bg-transparent border border-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Crear Log</button>
                </div>
            </div>
        </li>
    </ul>

</form>

