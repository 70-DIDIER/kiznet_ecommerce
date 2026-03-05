<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation de commande</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
        <h2>Confirmation de votre commande</h2>
        <p>Bonjour {{ $order->customer_name }},</p>
        <p>Votre commande a été validée avec succès.</p>

        <h3>Détails de la commande #{{ $order->id }}</h3>
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="text-align:left; border-bottom: 1px solid #ddd; padding: 8px;">Produit</th>
                    <th style="text-align:right; border-bottom: 1px solid #ddd; padding: 8px;">Quantité</th>
                    <th style="text-align:right; border-bottom: 1px solid #ddd; padding: 8px;">Prix unitaire (FCFA)</th>
                    <th style="text-align:right; border-bottom: 1px solid #ddd; padding: 8px;">Sous-total (FCFA)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $it)
                <tr>
                    <td style="padding: 8px;">{{ $it['name'] }}</td>
                    <td style="padding: 8px; text-align:right;">{{ $it['quantity'] }}</td>
                    <td style="padding: 8px; text-align:right;">{{ number_format($it['unit_price'], 2) }}</td>
                    <td style="padding: 8px; text-align:right;">{{ number_format($it['sub_total'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p style="text-align:right; font-weight:bold;">Total: {{ number_format($order->total, 2) }} FCFA</p>

        <p>Adresse de livraison: {{ $order->customer_address }}</p>
        @if ($order->notes)
        <p>Informations complémentaires: {{ $order->notes }}</p>
        @endif

        <p>Merci pour votre confiance.</p>
    </div>
</body>
</html>
