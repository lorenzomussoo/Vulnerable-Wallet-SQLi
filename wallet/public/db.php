<?php
$conn = mysqli_connect("db", "root", "root", "wallet");
if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}
?>
