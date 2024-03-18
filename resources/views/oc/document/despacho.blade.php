<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pompeyo Carrasco | OC N° {{ $ocPurchaseOrder->id }}</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .col-lg-6 {
            width: 50%;
            float: left;
        }

        .col-lg-4 {
            width: 33.33%;
            float: left;
        }

    </style>

</head>
<body>

<table style="width: 100%; border: 1px solid gray; border-collapse: collapse;">
    <tr>
        <td style="border-right: 1px solid gray; text-align: center" class="col-lg-6">
            <img src="{{ public_path('assets/img/Logo_Pompeyo.png') }}" style="width: 150px; margin: 10px 0;" alt="">
        </td>
        <td></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray; padding-left: 10px;" class="col-lg-4">
            {{ $ocPurchaseOrder->business->Empresa }}

        </td>
        <td style="border-right: 1px solid gray; padding-left: 10px;" class="col-lg-6">
            <strong style="text-transform: uppercase">Orden de Compra N°: </strong>
            {{ $ocPurchaseOrder->id }}
        </td>
    </tr>

    <tr>
        <td style="border-right: 1px solid gray; padding-left: 10px;" class="col-lg-6">
            Rut: {{ Rut::parse($ocPurchaseOrder->business->Rut)->format()   }}

        </td>
        <td style="padding-left: 10px;" class="col-lg-6">
            Fecha: {{ $date->format('d-m-Y') }}
        </td>
    </tr>

    <tr>
        <td style="border-right: 1px solid gray; padding-left: 10px;">
            Giro: Venta de vehiculos nuevos y repuestos
        </td>

        <td style="padding-left: 10px;">
            Solicitante:
            @if( isset($ocPurchaseOrder->orderRequest[0]))
                {{ $ocPurchaseOrder->orderRequest[0]->ocRequestPurchase->approvals[sizeof($ocPurchaseOrder->orderRequest[0]->ocRequestPurchase->approvals) - 1 ]->user->Nombre }}
            @else
                {{ $applicant }}
            @endif

        </td>
    </tr>

    <tr>
        <td style="border-right: 1px solid gray; padding-left: 10px;">
            Dirección: {{ $ocPurchaseOrder->business->Direccion }}
        </td>
        <td style="padding-left: 10px;">
            Comprador: {{ $ocPurchaseOrder->recorder->Nombre }}
        </td>
    </tr>

    <tr>
        <td style="border-right: 1px solid gray; padding-left: 10px;">

        </td>

        <td style="padding-left: 10px;">
            Tel: {{ $ocPurchaseOrder->recorder->Celular }}
    </tr>

    <tr>
        <td style="border-right: 1px solid gray; padding-left: 10px;">

        </td>
        <td style="padding-left: 10px;">
            E-Mail: {{ $ocPurchaseOrder->recorder->Email }}
        </td>
    </tr>


    <tr>
        <td style="border-right: 1px solid gray; padding-left: 10px;">

        </td>
        <td style="padding-left: 10px;">
            Cond. de pago: {{ $ocPurchaseOrder->payment->name }}
        </td>
    </tr>

    <tr>
        <td style="border-right: 1px solid gray; padding-left: 10px;">

        </td>
        <td style="padding-left: 10px;">

        </td>
    </tr>

    <tr>
        <td style="border-right: 1px solid gray; padding-left: 10px;">

        </td>
        <td style="padding-left: 10px;">
            Moneda: Pesos
        </td>
    </tr>

</table>

{{--<table style="width: 100%; border: 1px solid gray">
    <tr>
        <td style="padding: 5px;">
            Lugar de entrega en {{ $ocPurchaseOrder->direction }}, {{ $ocPurchaseOrder->communes->Comuna }} a {{ $ocPurchaseOrder->contact->Nombre ?? $ocPurchaseOrder->recorder->Nombre }}.
            Horarios de lunes a viernes 8:30 - 13:30 / 15:00 - 18:00 Hrs.
        </td>
    </tr>
</table>--}}

<table style="width: 100%; border: 1px solid gray; margin-top: 6px; margin-bottom: 6px;">

    <tr>
        <td>
            Proveedor
        </td>
        <td>

        </td>
    </tr>
    <tr>
        <td>
            <strong>{{ $ocPurchaseOrder->seller->name }}</strong>
        </td>
        <td>

        </td>
    </tr>
    <tr>
        <td>
            RUT: {{ Rut::parse($ocPurchaseOrder->seller->rut)->format()  }}
        </td>
        <td>
            Dirección de Despacho
        </td>
    </tr>

    <tr>
        <td>
            Dirección: {{ $ocPurchaseOrder->seller->address }}
        </td>
        <td>
            Dirección: {{ $ocPurchaseOrder->direction }}
        </td>
    </tr>

    <tr>
        <td>
            Comuna: {{ $ocPurchaseOrder->seller->city }}
        </td>
        <td>
            Comuna: {{ $ocPurchaseOrder->communes->Comuna }}
        </td>
    </tr>

    <tr>
        <td>
            Telefono: {{ $ocPurchaseOrder->seller->phone }}
        </td>
        <td>
            Horario: 14 a 18 hrs
        </td>
    </tr>
    <tr>
        <td>
            E-Mail: {{ $ocPurchaseOrder->seller->email }}
        </td>
        <td>
            Contacto:  <strong>{{ $ocPurchaseOrder->contact->Nombre ?? '' }}</strong>
        </td>
    </tr>
</table>

<table width="100%" style="width: 100%; border: 1px solid gray; margin-top: 6px; margin-bottom: 6px;">
    <thead style="background-color: lightgray;">
    <tr style="background-color: #908e8e; color: white;">
        <th>Articulos</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Valor Unitario</th>
        <th>Valor Neto</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $ocDetailPurchaseOrder as $item)
        <tr>
            <td align="left">{{ $item->ocProduct->name }}</td>
            <td>{{ $item->description }} </td>
            <td align="right">{{ number_format(  $item->amount , 0, '', '.') }}</td>
            <td align="right">{{ number_format(  $item->unitPrice , 0, '', '.') }}</td>
            <td align="right">{{ number_format(  $item->totalPrice , 0, '', '.')  }}</td>
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td align="right" style="background-color: #908e8e; color: white;">Total Neto</td>
        <td align="right" class="gray">
            {{ number_format( $ocDetailPurchaseOrder->sum('totalPrice') , 0, '', '.') }}
        </td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td align="right" style="background-color: #908e8e; color: white;">Total Impuesto</td>
        <td align="right" class="gray">
                {{ number_format( round( $ocDetailPurchaseOrder->sum('taxAmount') ) , 0, '', '.') }}
        </td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td align="right" style="background-color: #908e8e; color: white;">Total</td>
        <td align="right" class="gray">
                {{ number_format( round( $ocDetailPurchaseOrder->sum('totalPrice') + $ocDetailPurchaseOrder->sum('taxAmount') ) , 0, '', '.') }}
        </td>
    </tr>
    </tfoot>
</table>
<p style="font-weight: bold; text-transform: uppercase">
    SE INFORMA QUE TODA FACTURA QUE NO INDIQUEN NUMERO DE ORDEN DE COMPRA SERA RECHAZADA, FAVOR ENVIAR FACTURA EN PDF A PROVEEDORES@POMPEYO.CL
</p>

<table style="width: 100%; margin-top: 100px;">
    <tr style="text-align: center">
        <td>
            @if( Storage::disk('public')->exists('firmaoc/'.$ocPurchaseOrder->recorder->Rut.'.jpg'))
            <img src="{{ storage_path('app/public/firmaoc/'.$ocPurchaseOrder->recorder->Rut.'.jpg') }}" style="width: 150px; margin: 10px 0;" alt="">
            @endif
        </td>
        @foreach( $approver->reverse() as $job)
            <td>
                @if( Storage::disk('public')->exists('firmaoc/'.$job->user->Rut.'.jpg'))
                    <img src="{{ storage_path('app/public/firmaoc/'.$job->user->Rut.'.jpg') }}" style="width: 150px; margin: 10px 0;" alt="">
                @endif
            </td>
        @endforeach
    </tr>
    <tr style="text-align: center">
        <td>

            @if( isset($ocPurchaseOrder->orderRequest[0]))
                {{ $ocPurchaseOrder->orderRequest[0]->ocRequestPurchase->approvals[sizeof($ocPurchaseOrder->orderRequest[0]->ocRequestPurchase->approvals) - 1 ]->user->Nombre }}<br>
                <strong>
                    {{ $ocPurchaseOrder->orderRequest[0]->ocRequestPurchase->approvals[sizeof($ocPurchaseOrder->orderRequest[0]->ocRequestPurchase->approvals) - 1 ]->user->position->Cargo }}
                </strong>
            @else
                {{ $ocPurchaseOrder->recorder->Nombre }}<br>
                <strong style="font-size: 0.7rem">{{ $ocPurchaseOrder->recorder->position->Cargo }}</strong>
            @endif
        </td>
        @foreach( $approver->reverse() as $job)
            <td>
                {{ $job->user->Nombre }}<br>
                <strong style="font-size: 0.7rem">{{ $job->user->position->Cargo }}</strong>
            </td>
        @endforeach
    </tr>
    <tr style="text-align: center">
        <td>
            <strong>Solicitante</strong>
        </td>
        @foreach( $approver as $key => $job)
            <td>
                <strong>Aprobador {{ $key + 1 }}</strong>
            </td>
        @endforeach
    </tr>
</table>
</body>
</html>
