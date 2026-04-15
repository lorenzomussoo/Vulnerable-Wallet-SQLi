<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Wallet Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(-45deg, #6a11cb, #2575fc, #b27cff, #7ab8ff, #70e1f5, #ffd6ff);
            background-size: 600% 600%;
            animation: gradientShift 8s ease infinite;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            25% {
                background-position: 50% 100%;
            }
            50% {
                background-position: 100% 50%;
            }
            75% {
                background-position: 50% 0%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .login-box {
            position: relative;
            padding: 40px 30px;
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(10px);         
            -webkit-backdrop-filter: blur(10px); 
            border-radius: 14px;
            text-align: center;
            z-index: 1;
            margin-top: 30px;
            border: 4px solid rgba(255, 255, 255, 0.41);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        h1 {
            font-size: 36px;
            color: white;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 24px;
            color: white;
            margin-top: 0px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-top: 15px;
            color: white;
        }

        input {
            display: block;
            margin-top: 5px;
            padding: 10px;
            width: 93.5%;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(10px);         
            -webkit-backdrop-filter: blur(10px); 
            border: 1px solid rgba(255, 255, 255, 0.41);
            color: white;
            font-style: italic;
        }

        input::placeholder {
            color: rgb(255, 255, 255); 
            font-style: italic;
        }

        input:focus {
            outline: none;
            border-color:rgba(255, 255, 255, 0.77);
            box-shadow: 0 0 5px 2px rgba(255, 255, 255, 0.5); 
        }

        button {
            margin-top: 25px;
            padding: 12px 25px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(10px);         
            -webkit-backdrop-filter: blur(10px); 
            border: 3px solid rgba(255, 255, 255, 0.41);
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            border-color:rgba(255, 255, 255, 0.77);
            background: rgba(255, 255, 255, 0.51);
            box-shadow: 0 0 5px 2px rgba(255, 255, 255, 0.5); 
        }
    </style>
</head>
<body>
    <h1>Wallet</h1>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="post" action="login.php">
                <label for="username">Inserisci username</label>
                <input type="text" id="username" name="username" placeholder="Username" required>

                <label for="password">Inserisci password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>

                <button type="submit">Apri il Tuo Wallet!</button>
            </form>
        </div>
    </div>
</body>
</html>