<?php
if(isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "includes/database.php";
    require_once "secure.php";

    // Get form data
    $naam = mysqli_real_escape_string($db, $_POST['naam']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $wachtwoord = $_POST['wachtwoord'];

    // Server-side validation
    $errors = [];
    if($naam == '') {
        $errors['naam'] = 'Please fill in your naam.';
    }
    if($email == '') {
        $errors['email'] = 'Please fill in your email.';
    }
    if($wachtwoord == '') {
        $errors['wachtwoord'] = 'Please fill in your wachtwoord.';
    }

    // If data valid
    if(empty($errors)) {
        // create a secure password, with the PHP function password_hash()
        $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

        // store the new user in the database.
        $query = "INSERT INTO users (naam, email, wachtwoord) VALUES ('$naam', '$email', '$wachtwoord')";

        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: login.php');
            exit;
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

    <title>Registreren</title>
</head>
<body>

<section class="section">
    <div class="container content">
        <h2 class="title">Register With Email</h2>
        <?php if(isset($naam) && $naam != '') { ?>
            <p>Welkom, <?= htmlentities($naam) ?></p>
        <?php } ?>

        <section class="columns">
                <form class="column is-6" action="" method="post">

                    <!-- Name -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="naam">naam</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="naam" type="text" name="naam" value="<?= $naam ?? '' ?>" />
                                    <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['naam'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
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

                    <!-- Password -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="wachtwoord">wachtwoord</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="wachtwoord" type="password" name="wachtwoord"/>
                                    <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['wachtwoord'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth" type="submit" name="submit">Registreer</button>
                        </div>
                    </div>

                </form>
            </section>

    </div>
</section>
</body>
</html>
