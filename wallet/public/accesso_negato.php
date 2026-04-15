<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Accesso Negato</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(-45deg, #6a11cb, #2575fc, #b27cff, #7ab8ff, #70e1f5, #ffd6ff);
            background-size: 600% 600%;
            animation: gradientShift 8s ease infinite;
            color: white;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            25% { background-position: 50% 100%; }
            50% { background-position: 100% 50%; }
            75% { background-position: 50% 0%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 4px solid rgba(255, 255, 255, 0.41);
        }

        h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: 0px;
        }

        .alert {
            background-color: rgba(255, 0, 0, 0.3);
            border: 2px solid rgba(255, 0, 0, 0.5);
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .btn {
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.5);
            border-color: rgba(255, 255, 255, 0.7);
            box-shadow: 0 0 5px 2px rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Accesso Negato</h2>
    <div class="alert">
        Credenziali errate. Riprova con un account valido.
    </div>
    <a href="index.php" class="btn">Torna alla pagina di login</a>
</div>
</body>
</html>