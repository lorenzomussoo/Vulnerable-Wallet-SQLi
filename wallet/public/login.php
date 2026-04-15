<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"], $_POST["password"])) {
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["password"] = $_POST["password"];
    header("Location: wallet.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}