<div>
    {{$searchGerencia}}
    {{$searchSucursal}}
    {{$searchVendedores}}
    {{$searchMarca}}
    {{$searchTipoVenta}}
    {{$searchModelo}}
    {{$searchCanal}}
    {{$searchCierre}}
    {{$searchCupon}}
    {{$searchOficina}}
    {{$inputFechaInicio}}
    {{$inputFechaFin}}
    <table
        class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 text-size-xxs">
        <tbody>
        <tr class="bg-blue-400 ">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Ventas Total (%)
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Facturados Total
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Vigentes Total
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Proy Ventas Total
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Cotizaciones Total
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Inscripciones Total
            </th>
            <th class="text-white px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap  ">
                Facturados Total(con arrastre)
            </th>
        </tr>
        <tr>
            <th class="py-3">{{$datos[0]}} (35.95%)</th>
            <th class="py-3">{{$datos[1]}}</th>
            <th class="py-3">{{$datos[2]}}</th>
            <th class="py-3">{{$datos[3]}}</th>
            <th class="py-3">{{date('d',strtotime(date('Y-m-d').'-1 day')) }}</th>
            <th class="py-3">{{$datos[5]}}</th>
            <th class="py-3">0</th>
        </tr>

        <tr class="bg-blue-400 ">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Ventas Piso (%)
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Facturados Piso
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Vigentes Piso
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Proy Ventas Piso
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Cotizaciones Piso
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Tasa Cierre
            </th>
            <th class="text-white px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap  ">
                Proy Cotizaciones Total
            </th>
        </tr>
        <tr>
            <th class="py-3">47 (Infinity%)</th>
            <th class="py-3">9</th>
            <th class="py-3">38</th>
            <th class="py-3">1410</th>
            <th class="py-3">79</th>
            <th class="py-3">35.95%</th>
            <th class="py-3">4590</th>
        </tr>

        <tr class="bg-blue-400 ">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Ventas Web (%)
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Facturados Web
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Vigentes Web
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Proy Ventas Web
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Cotizaciones Web
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Leads Total
            </th>
            <th class="text-white px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap  ">
                Cot/Der
            </th>
        </tr>
        <tr>
            <th class="py-3">0 (0.00%)</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">72</th>
            <th class="py-3">78</th>
            <th class="py-3">0.00%</th>
        </tr>

        <tr class="bg-blue-400 ">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Ventas Ren (%)
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Facturados Ren
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Vigentes Ren
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Proy Ventas Ren
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Cotizaciones Ren
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Camada Ren
            </th>
            <th class="text-white px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap  ">
                % Cierre Camadas
            </th>
        </tr>
        <tr>
            <th class="py-3">0 (0.00%)</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">1025</th>
            <th class="py-3">0.00%</th>
        </tr>

        <tr class="bg-blue-400 ">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Ventas Flotas (%)
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Facturados Flotas
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Vigentes Flotas
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Cotizaciones Flotas
            </th>

        </tr>
        <tr>
            <th class="py-3">8 (Infinity%)</th>
            <th class="py-3">0</th>
            <th class="py-3">8</th>
            <th class="py-3">2</th>

        </tr>


        <tr class="bg-blue-400 ">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Actas Entrega
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Actas Entrega Pendientes
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Tasaciones (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Retomas (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Pend Inscripción
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Inscripción Sol
            </th>
            <th class="text-white px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap  ">
                Cliente Inscribe
            </th>
        </tr>
        <tr>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">0 (0.00%)</th>
            <th class="py-3">1 (1.82%)	</th>
            <th class="py-3">2</th>
            <th class="py-3">51</th>
            <th class="py-3">0</th>
        </tr>

        </tbody>
    </table>

    <hr>
    <table
        class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 text-size-xxs">
        <tbody>
        <tr class="bg-orange-400">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Total Mpp (%)
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Total MI (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Total Opti (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Primera Mantención (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Segunda Mantención (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Tercera Mantención (%)
            </th>

        </tr>
        <tr>
            <th class="py-3">4 (7.27%)</th>
            <th class="py-3">3 (5.45%)</th>
            <th class="py-3">7 (12.73%)</th>
            <th class="py-3">6 (10.91%)</th>
            <th class="py-3">3 (5.45%)</th>
            <th class="py-3">3 (5.45%)</th>
        </tr>
        </tbody>
    </table>

    <hr>
    <table
        class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 text-size-xxs">
        <tbody>

        <tr class="bg-orange-500">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Creditos Totales (%)
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Solicitudes (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Aprobados (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                % Cierre Aprobados
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Sol/Rech
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Compra Inteligente (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Cobertura Total
            </th>

        </tr>
        <tr>
            <th class="py-3">30 (54.55%)</th>
            <th class="py-3">10 (6.54%)</th>
            <th class="py-3">4 (40.00%)</th>
            <th class="py-3">750.00%</th>
            <th class="py-3">0%</th>
            <th class="py-3">9 (16.36%)</th>
            <th class="py-3">18.18%</th>
        </tr>


        <tr class="bg-orange-500">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Creditos Primera Op
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Solicitudes (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Aprobados (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                % Cierre Aprobados
            </th>


        </tr>
        <tr>
            <th class="py-3">19 (34.55%)</th>
            <th class="py-3">10 (6.54%)</th>
            <th class="py-3">4 (40.00%)</th>
            <th class="py-3">750.00%</th>
        </tr>

        <tr class="bg-orange-500">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Creditos Segunda Op
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Solicitudes (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Aprobados (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                % Cierre Aprobados
            </th>


        </tr>
        <tr>
            <th class="py-3">1 (1.82%)</th>
            <th class="py-3">0 (0.00%)</th>
            <th class="py-3">0 (0.00%)</th>
            <th class="py-3">Infinity%</th>
        </tr>

        <tr class="bg-orange-500">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Creditos Otros
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Solicitudes (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Aprobados (%)
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                % Cierre Aprobados
            </th>

        </tr>
        <tr>
            <th class="py-3">9 (16.36%)</th>
            <th class="py-3">0 (0.00%)</th>
            <th class="py-3">0 (0.00%)</th>
            <th class="py-3">Infinity%</th>
        </tr>

        </tbody>
    </table>

    <hr>
    <table
        class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 text-size-xxs">
        <tbody>
        <tr class="bg-sky-300">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Total Seguros (%)
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Deducible 0
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Deducible 3
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Deducible 5
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Deducible 10
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Promedio Prima Neta Uf
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Multianual (%)
            </th>

        </tr>
        <tr>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
            <th class="py-3">0</th>
        </tr>


        </tbody>
    </table>

    <hr>
    <table
        class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 text-size-xxs">
        <tbody>
        <tr class="bg-red-500">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Ticket Promedio
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Ticket Total
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Bono Financiamiento
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Bono Marca
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                % Desc
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Proyección Utilidad
            </th>

        </tr>
        <tr>
            <th class="py-3">$12.783.250</th>
            <th class="py-3">$13.521.447</th>
            <th class="py-3">$16.050.415</th>
            <th class="py-3">$24.550.413</th>
            <th class="py-3">2.24%</th>
            <th class="py-3">$2.591.652.180</th>
        </tr>


        <tr class="bg-red-500">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Utilidad Total Promedio
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Utilidad Prom x Auto
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Preevaluación Prom x Auto
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Preevaluación Prom x Credito
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Preevaluación CC
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Preevaluación CI
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Preevaluación Total
            </th>

        </tr>
        <tr>
            <th class="py-3">$1.570.698</th>
            <th class="py-3">$1.424.800</th>
            <th class="py-3">$145.897</th>
            <th class="py-3">$267.479</th>
            <th class="py-3">$2.237.391</th>
            <th class="py-3">$5.786.983</th>
            <th class="py-3">$8.024.374</th>
        </tr>


        <tr class="bg-red-500">
            <th class="text-white px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Utilidad Total
            </th>
            <th class="text-white px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Utilidad x Auto
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Colocación
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Total Accesorios
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Utilidad Accesorios
            </th>
            <th class="text-white px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                Penetración Accesorios
            </th>

        </tr>
        <tr>
            <th class="py-3">$86.388.406</th>
            <th class="py-3">$78.364.032</th>
            <th class="py-3">$146.014.436</th>
            <th class="py-3">13</th>
            <th class="py-3">$31.444</th>
            <th class="py-3">23.64%</th>
        </tr>

        </tbody>
    </table>
</div>
