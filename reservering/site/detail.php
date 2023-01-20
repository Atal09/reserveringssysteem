<?php
/** @var mysqli $db */

//doorsturen wanneer uri geen id bevat
if(!isset($_GET['id']) || $_GET['id'] == '') {
    // redirect to index.php
    header('Location: index.php');
    exit;
}

//vereist database in dit bestand
require_once "includes/database.php";

//haal de GET-parameter op uit de 'Super global'
$reservering_id = mysqli_escape_string($db, $_GET['id']);

//haal het record op uit de databaseresultaten
$query = "SELECT * FROM reservering WHERE id = '$reservering_id'";
$result = mysqli_query($db, $query)
or die ('Error: ' . $query );

if(mysqli_num_rows($result) != 1)
{
    //doorsturen wanneer de database geen resultaten geeft
    header('Location: detail.php');
    exit;
}

$reservering = mysqli_fetch_assoc($result);





//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Details - <?= $reservering['naam'] ?></title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4"><?= $reservering['naam'] ?></h1>
    <section class="content">
        <ul>
            <li>Datum: <?= $reservering['datum'] ?></li>
            <li>Telefoonnummer: <?= $reservering['telefoonnummer'] ?></li>
        </ul>
    </section>
    <div>
        <a class="button" href="index.php">Ga terug</a>
    </div>
</div>
</body>
</html>
