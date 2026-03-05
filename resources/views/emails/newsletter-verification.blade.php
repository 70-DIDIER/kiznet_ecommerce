<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
    </style>

</head>

<body>
    <div class="container">
        <h2>Bienvenue, {{ $subscriber->name }} !</h2>

        <p>Merci de vous être inscrit à notre newsletter.</p>

        <p>Pour confirmer votre inscription, veuillez cliquer sur le bouton ci-dessous :</p>

        <a href="{{ route('newsletter.verify', $subscriber->token) }}" class="button">
            Confirmer mon inscription
        </a>

        <p>Ou copiez ce lien dans votre navigateur :</p>
        <p>{{ route('newsletter.verify', $subscriber->token) }}</p>

        <div class="footer">
            <p>Si vous n'avez pas demandé cette inscription, ignorez simplement cet email.</p>
            <p>Pour vous désinscrire : <a href="{{ route('newsletter.unsubscribe', $subscriber->token) }}">Cliquez
                    ici</a></p>
        </div>
    </div>
</body>

</html>
