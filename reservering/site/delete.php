<?php
/** @var mysqli $db */


//Vereist database in dit bestand
require_once "includes/database.php";

//Haal de GET-parameter op uit de 'Super Global'
$reservering_id = mysqli_escape_string($db, $_GET['id']);

//Haal het record op uit de databaseresultaten
$query = "DELETE FROM reservering WHERE id = '$reservering_id'";
$result = mysqli_query($db, $query);


header('Location: reservering.php');

?>
