<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();
include("db.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null) {
        header("Content-Type: application/json");
        echo json_encode([
            "data" => [],
            "error" => "Errore critico: " . $error["message"],
            "debug" => []
        ]);
    }
});
ob_start();
header("Content-Type: application/json");

$username = $_SESSION["username"] ?? null;
$password = $_SESSION["password"] ?? null;

$data = [];
$error = "";
$debug = [ 
    "query" => "",
    "results" => [],
    "errors" => []
];
if ($username && $password) {
    $base_query = "
        SELECT credit_cards.card_number, credit_cards.expiry_date, credit_cards.cvv, credit_cards.circuit
        FROM users 
        JOIN credit_cards ON users.id = credit_cards.user_id 
        WHERE users.username = '$username' AND (users.password = '$password');
    ";
    
    $debug["query"] = $base_query;
    try {
        if (mysqli_multi_query($conn, $base_query)) {
            do {
                $debug["errors"] = [];
    
                if (mysqli_field_count($conn)) {
                    $result = mysqli_store_result($conn);
                    if ($result) {
                        $batch = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $batch[] = $row;
                        }
                        $data = array_merge($data, $batch);
                        $debug["results"][] = $batch;
                        mysqli_free_result($result);
                    }
                } else {
                    $debug["results"][] = "Query senza risultati (non-SELECT)";
                }
    
                if ($err = mysqli_error($conn)) {
                    $debug["errors"][] = $err;
                    $error .= $err . " ";
                } else {
                    $debug["errors"][] = "Nessun errore, ma nessun risultato visibile.";
                }
            } while (mysqli_more_results($conn) && mysqli_next_result($conn));
        } else {
            $error = "Errore SQL: " . mysqli_error($conn);
            $debug["errors"][] = $error;
        }
    } catch (mysqli_sql_exception $e) {
        $error = "Errore critico: " . $e->getMessage();
        $debug["errors"][] = $error;
    }
    $check_user_query = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
    $debug["check_query"] = $check_user_query;

    if (empty($data) && empty($error)) {
        $check_user_query = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
        $check_result = mysqli_query($conn, $check_user_query);
        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $data = [];
            mysqli_free_result($check_result);
        } else {
            $error = "Login fallito! Credenziali errate.";
            session_destroy();
        }
    }
} else {
    $error = "Accesso non valido.";
}

ob_end_clean();
file_put_contents("debug_log.txt", "DATA:\n" . print_r($data, true) . "\nERROR:\n" . $error . "\nDEBUG:\n" . print_r($debug, true));
echo json_encode([
    "data" => $data,
    "error" => $error,
    "debug" => $debug 
], JSON_PRETTY_PRINT);