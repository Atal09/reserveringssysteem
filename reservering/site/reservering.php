<?php
/** @var mysqli $db */

//Vereist DB-instellingen met verbindingsvariabele"
require_once "includes/database.php";
require_once "secure.php";

//Haal de resultset op uit de database met een SQL-query
$query = "SELECT * FROM reservering";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

//Doorloop de resultaten om een aangepaste array te maken
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

//sluit de connectie
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>reservering</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">reservering</h1>
    <hr>
    <a class="button is-link" href="create.php">nieuwe reservering maken</a>
    <table class="table is-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Naam</th>
            <th>Email</th>
            <th>Datum</th>
            <th>telefoonnummer</th>
            <th>Details</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="8" class="has-text-centered">&copy; Mijn reserveringen</td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($data as $index => $reservering) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $reservering['naam'] ?></td>
                <td><?= $reservering['email'] ?></td>
                <td><?= $reservering['datum'] ?></td>
                <td><?= $reservering['telefoonnummer'] ?></td>
                <td><a href="detail.php?id=<?= $reservering['id'] ?>">Details</a></td>
                <td><a href="edit.php?id=<?= $reservering['id'] ?>">Edit</a></td>
                <td><a href="delete.php?id=<?= $reservering['id'] ?>">Delete</a></td>


            </tr>
        <?php } ?>

        </tbody>

    </table>
    <button class="button has-background-white">
    <a href="logout.php">uitloggen</a>
    </button>

</div>
</body>
</html>
