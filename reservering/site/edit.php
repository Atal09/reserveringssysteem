<?php
/** @var $db */
//vereist database in dit bestand
require_once "includes/database.php";


$id = $_GET['id'];
if (isset($id)) {
    //selecteer de data uit de reservering
    $query2 = "SELECT * FROM `reservering` WHERE id = $id";
    $result2 = mysqli_query($db, $query2);
    if (mysqli_num_rows($result2) == 1) {
        $reservering = mysqli_fetch_assoc($result2);
        $naam = $reservering['naam'];
        $email = $reservering['email'];
        $datum = $reservering['datum'];
        $telefoonnummer = $reservering['telefoonnummer'];
    }
}

if (isset($_POST['submit'])) {
    //Post terug met de gegevens die aan de gebruiker worden getoond, haal eerst gegevens op uit 'Super global'
    $naam   = mysqli_escape_string($db, $_POST ['naam']);
    $email   = mysqli_escape_string($db, $_POST ['email']);
    $datum   = mysqli_escape_string($db, $_POST ['datum']);
    $telefoonnummer   = mysqli_escape_string($db, $_POST ['telefoonnummer']);
    //vereist de behandeling van formuliervalidatie
    require_once "includes/form-validation.php";
    //vereist database in dit bestand
    require_once "includes/database.php";

    if (empty($errors)) {
        //vereist database in dit bestand
        require_once "includes/database.php";

        //Sla het record op in de database
        $query="UPDATE `reservering` SET `naam`='$naam',`email`='$email',`datum`='$datum',`telefoonnummer`='$telefoonnummer' WHERE `id`=$id";

        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        //Sluit verbinding
        mysqli_close($db);

        //Redirect naar reservering.php
        header('Location: reservering.php');
        exit;
        $reservering = mysqli_fetch_assoc($result);
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Edit - <?= $reservering['naam'] ?></title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">Edit</h1>

    <section class="columns">
        <form class="column is-6" action="" method="post">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="naam">naam</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="naam" type="text" name="naam" value="<?= $naam ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['naam'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>



            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="email">email</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="email" type="text" name="email" value="<?= $email ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['email'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="year">datum</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="datum" type="datetime-local" name="datum" value="<?= $datum ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['datum'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="tracks">telefoonnummer</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="tracks" type="text" name="telefoonnummer" value="<?= $telefoonnummer ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['telefoonnummer'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal"></div>
                <div class="field-body">
                    <button class="button is-link is-fullwidth" type="submit" name="submit">Save</button>
                </div>
            </div>
        </form>
    </section>
    <a class="button mt-4" href="index.php">&laquo; Go back to the list</a>
</div>
</body>
</html>

