<?php
/** @var mysqli $db */

//Controleer of Post is ingevuld, anders doe niets
if (isset($_POST['submit'])) {
    //Vereist database in dit bestand
    require_once "includes/database.php";

    //Post terug met de gegevens die aan de gebruiker worden getoond, haal eerst gegevens op uit de 'Super global'
    $naam   = mysqli_escape_string($db, $_POST ['naam']);
    $email =  mysqli_escape_string($db, $_POST ['email']);
    $datum  = mysqli_escape_string($db, $_POST ['datum']);
    $telefoonnummer =   mysqli_escape_string($db, $_POST ['telefoonnummer']);

    if ($naam == "") {
        $errors['name'] = 'naam mag niet leeg zijn';
    }
    if ($email == "") {
        $errors['email'] = 'email mag niet leeg zijn';
    }
    if ($datum == "") {
        $errors['datum'] = 'datum mag niet leeg zijn';
    }
    if ($telefoonnummer == "") {
        $errors['telefoonnummer'] = 'telefoonnummer mag niet leeg zijn';
    }
    //Vereist de behandeling van formuliervalidatie
    require_once "includes/form-validation.php";

    if (empty($errors)) {
        //Sla het record op in de database
        require_once "includes/database.php";
        $query = "INSERT INTO reservering (naam, email, datum, telefoonnummer)
              VALUES ('$naam', '$email', '$datum', '$telefoonnummer')";

        $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
        //Sluit verbinding
        mysqli_close($db);

        //Redirect naar reservering.php
        header('Location: reservering.php');
        exit;
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
    <title>reservering toevoegen -</title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">Reservering toevoegen</h1>

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
                    <label class="label" for="datum">datum</label>
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
                    <label class="label" for="telefoonnummer">telefoonnummer</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="telefoonnummer" type="text" name="telefoonnummer" value="<?= $telefoonnummer ?? '' ?>"/>
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
                    <button class="button is-link is-fullwidth" type="submit" name="submit">opslaan</button>
                </div>
            </div>
        </form>
    </section>
    <a class="button mt-4" href="reservering.php">&laquo; Go back to the list</a>
</div>
</body>
</html>
