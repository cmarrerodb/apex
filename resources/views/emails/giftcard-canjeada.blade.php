<html>
    <body>
        <p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px' style="padding:10px"></p>
        <p align='center'><img src='data:image/png;base64,{{ $qr }}'  style="padding:10px"></p>
        <p>Ha sido  Canjeado una Giftcard</p>        
        @if ($tipo=='comprador' || $tipo=='administrador' )
            <p>Autorizado por: {{ auth()->user()->name }}</p>
        @endif        
        <h4>Detalle de la Giftcard:</h4>
        <table style="border-collapse:collapse; width:100%; ">
        <thead>
            <tr style="text-align:left">
                <th style="border:1px solid #333; padding:5px">Código</th>
                <th style="border:1px solid #333; padding:5px">Beneficiario</th>
                <th style="border:1px solid #333; padding:5px">Mensaje</th>
                <th style="border:1px solid #333; padding:5px">Monto</th>
                <th style="border:1px solid #333; padding:5px">Ver Giftcard</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border:1px solid #333; padding:5px">{{ $gift->codigo }}</td>
                <td style="border:1px solid #333; padding:5px">{{ $gift->beneficiario }}</td>
                <td style="border:1px solid #333; padding:5px">{{ $gift->mensaje_beneficiario}}</td>
                <td style="border:1px solid #333; padding:5px">${{ number_format($gift->new_ben_monto,0,".","") }}</td>
                <td style="border:1px solid #333; padding:5px">
                    <a href="{{ route('giftcard_check', ['codigo' => $gift->codigo]) }}">{{ route('giftcard_check', ['codigo' => $gift->codigo]) }}</a>
                </td>
            </tr>
        </tbody>
    </table>
    <p><br>Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>
    </body>
</html>