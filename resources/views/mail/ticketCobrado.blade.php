@php
use App\Models\FormaPago;
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura de su compra # {{ $ticket->id }} en {{ $ticket->centro->nombre }}</title>
</head>


<body
    style="display: flex; justify-content: center; font-family: Arial; flex-direction: column; align-items:center; gap: 1em; margin: 1em;">
    <div
        style="display: flex; justify-content: center; font-family: Arial; flex-direction: column; align-items:center; gap: 1em; margin: 1em;">
        <div
            style="width: 30em; color:white; background-color: #2a9d8f; padding-right: 2em; padding-left: 2em; padding-top:1em; padding-bottom:1em; border-radius: 10px; text-align: justify; margin: 1em;">
            <p><b>Hola {{ $cliente->nombre }} ,</b></p>
            <p>Aquí tiene su última factura:</p>
            <h4>Factura: #{{ $ticket->id }}</h4>
            <h1 style="margin: 0">{{ $centro->nombre }}</h1>
            <h2 style="margin: 0">{{ $centro->direccion }}</h2>
            <h3 style="margin: 0">{{ $centro->nombre_legal }}</h3>
            <h3 style="margin: 0">({{ $centro->nif }})</h3>
            <div>
                <h5 style="margin: 0">{{ $cliente->nombre_fiscal }} </h5>
                <h5 style="margin: 0">NIF: {{ $cliente->nif }}</h5>
                <h5 style="margin: 0">Dirección: </h5>
                <p>{{ $cliente->direccion }}</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="text-align: left;">Artículo</th>
                        <th style="text-align: left;">Base Imp.</th>
                        <th style="text-align: left;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lineas as $linea)
                        <tr>
                            <td>{{ $linea['descripcion'] }}</td>
                            <td>{{ number_format($linea['baseImponible'], 2) }}</td>
                            <td>{{ number_format($linea['precio'], 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    @foreach ($impuestos as $impuesto)
                        @if ($impuesto['total'] > 0)
                            <tr>
                                <th style="text-align: right;">{{ $impuesto['nombre'] }}</th>
                                <td>{{ number_format($impuesto['baseImponible'], 2) }} €</td>
                                <td>{{ $impuesto['total'] }} €</td>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="3">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: right;">Total: </th>
                        <td>{{ number_format($total, 2) }} €</td>
                    </tr>
                    @foreach ($ticket->cobros as $cobro)
                        <tr>
                            <th colspan="2" style="text-align: left;">
                                {{ FormaPago::find($cobro->forma_pago_id)->nombre }}:</th>
                            <td colspan="1" style="text-align: right;">{{ number_format($cobro->cantidad, 2) }} €
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align: center;">Gracias por su visita</th>
                    </tr>
                </tbody>
            </table>

            <p style="margin-top: 1em; text-align:center">Copyright - Gestrón 2022</p>
        </div>
    </div>
</body>

</html>
