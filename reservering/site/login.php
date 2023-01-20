<?php
session_start();

$login = false;
//Is de gebruiker ingelogd?
if (isset($_SESSION['loggedInUser'])) {
    $login = true;
}

if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "includes/database.php";


    //Haal formuliergegevens op
    $email = mysqli_escape_string($db, $_POST['email']);
    $wachtwoord = $_POST['wachtwoord'];

    //Server-side validatie
    $errors = [];
    if ($email == '') {
        $errors['email'] = 'vul je email in.';
    }
    if ($wachtwoord == '') {
        $errors['wachtwoord'] = 'Vul je wachtwwoord in.';
    }

    //Als gegevens geldig zijn
    if (empty($errors)) {
        //SELECTEER de gebruiker uit de database op basis van het e-mailadres
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db, $query);

        //Controleer of de gebruiker bestaat
        if (mysqli_num_rows($result) == 1) {
            //Haal gebruikersgegevens op uit resultaat
            $user = mysqli_fetch_assoc($result);

            //Controleer of het opgegeven wachtwoord overeenkomt met het opgeslagen wachtwoord in de database
            if (password_verify($wachtwoord, $user['wachtwoord'])) {
                $login = true;

                //Sla de gebruiker op in de sessie
                $_SESSION['loggedInUser'] = [
                    'id'    => $user['id'],
                    'naam'  => $user['naam'],
                    'email' => $user['email'],
                ];

                //Redirect naar beveiligde pagina
            } else {
                //fout bij het inloggen
                $errors['loginFailed'] = 'The provided credentials do not match.';
            }
        } else {
            //fout bij het inloggen
            $errors['loginFailed'] = 'The provided credentials do not match.';
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Log in</title>
</head>
<body>
<section class="section">
    <div class="container content">
        <h2 class="title">Log in</h2>

        <?php if ($login) { ?>
            <p>Je bent ingelogd!</p>


            <p><button class="button has-background-white"><a href="logout.php">Uitloggen</a></button> / <button class="button has-background-white"><a href="reservering.php">Naar de reservering</a></button></p>
        <?php } else { ?>

        <section class="columns">
            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="email">Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="email" type="text" name="email" value="<?= $email ?? '' ?>" />
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['email'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="wachtwoord">Wachtwoord</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="wachtwoord" type="wachtwoord" name="wachtwoord"/>
                                <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>

                                <?php if(isset($errors['loginFailed'])) { ?>
                                <div class="notification is-danger">
                                    <button class="delete"></button>
                                    <?=$errors['loginFailed']?>
                                </div>
                                <?php } ?>

                            </div>
                            <p class="help is-danger">
                                <?= $errors['wachtwoord'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Log in With Email</button>
                    </div>
                </div>

            </form>
        </section>

        <?php } ?>
        <button class="button has-background-white"><a href="index.php">home pagina</a></button>

    </div>
</section>
</body>
</html>


