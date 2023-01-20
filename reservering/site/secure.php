<?php
session_start();

//als de user naam niet bestaat stuurt het je naar de login pagina
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

// Haal e-mail op uit sessie
$naam = $_SESSION['loggedInUser']['naam'];
?>
