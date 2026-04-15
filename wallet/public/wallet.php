<?php
session_start();
if (!isset($_SESSION["username"], $_SESSION["password"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Il Tuo Wallet</title>
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
            justify-content: flex-start;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            25% { background-position: 50% 100%; }
            50% { background-position: 100% 50%; }
            75% { background-position: 50% 0%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            background: transparent;
            border-radius: 14px;
            padding: 40px;
            max-width: 900px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        h2 {
            margin-top: 0;
            font-size: 32px;
            font-weight: bold;
        }

        .btn {
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.41);
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            margin-top: 30px;
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.5);
            border-color: rgba(255, 255, 255, 0.77);
            box-shadow: 0 0 5px 2px rgba(255, 255, 255, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: white;
            font-family: monospace;
        }

        th, td {
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.1);
        }

        th {
            background: rgba(255, 255, 255, 0.36);
        }

        #alert-area .alert {
            margin-top: 20px;
            padding: 15px;
            border-radius: 6px;
            font-weight: bold;
        }

        .alert-danger {
            background-color: rgba(255, 0, 0, 0.3);
            border: 2px solid rgba(255, 0, 0, 0.5);
        }

        .alert-warning {
            background-color: rgba(255, 165, 0, 0.3);
            border: 2px solid rgba(255, 165, 0, 0.5);
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Il Tuo Wallet</h2>

    <div id="alert-area"></div>
    <table id="wallet-table" style="display:none;">
        <thead>
            <tr id="wallet-header"></tr>
        </thead>
        <tbody id="wallet-body"></tbody>
    </table>

    <a href="logout.php" class="btn">Logout</a>
</div>

<script>
function fetchData() {
    fetch("fetch_wallet_data.php")
        .then(async response => {
            const text = await response.text();
            try {
                return JSON.parse(text);
            } catch (err) {
                throw new Error("Risposta non valida:\n" + text);
            }
        })
        .then(result => {
            const data = result.data;
            const error = result.error;
            const table = document.getElementById("wallet-table");
            const header = document.getElementById("wallet-header");
            const body = document.getElementById("wallet-body");
            const alertArea = document.getElementById("alert-area");

            if (error === "Login fallito! Credenziali errate.") {
                window.location.href = "accesso_negato.php";
                return;
            }

            if (error) {
                table.style.display = "none";
                alertArea.innerHTML = `<div class="alert alert-danger"> ${error}</div>`;
                return;
            }

            alertArea.innerHTML = data.length === 0 
                ? `<div class="alert alert-warning">Nessun risultato disponibile da mostrare.</div>`
                : "";

            if (!Array.isArray(data) || data.length === 0 || typeof data[0] !== "object") {
                table.style.display = "none";
                alertArea.innerHTML = `
                    <div class="alert alert-warning">Nessuna carta inserita nel wallet!</div>
                `;
                return;
            }

            table.style.display = "table";
            header.innerHTML = "";
            Object.keys(data[0]).forEach(key => {
                const th = document.createElement("th");
                const formattedKey = key
                    .replace(/_/g, ' ')                    
                    .replace(/\b\w/g, char => char.toUpperCase()); 
                th.textContent = formattedKey;
                header.appendChild(th);
            });

            body.innerHTML = "";
            data.forEach(row => {
                const tr = document.createElement("tr");
                Object.values(row).forEach(val => {
                    const td = document.createElement("td");
                    td.textContent = val;
                    tr.appendChild(td);
                });
                body.appendChild(tr);
            });
        })
        .catch(err => {
            document.getElementById("alert-area").innerHTML = `
                <div class="alert alert-danger">Errore di rete o JSON malformato: ${err.message}</div>
            `;
            console.error("Errore fetch:", err);
        });
}

fetchData();
setInterval(fetchData, 500);
</script>
</body>
</html>