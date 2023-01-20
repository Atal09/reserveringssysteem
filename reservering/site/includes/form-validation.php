<?php
//Check if data is valid & generate error if not so
/** @var mysqli $db */
$errors = [];
if ($naam == "") {
    $errors['naam'] = 'De Naam mag niet leeg zijn';
}
if ($email == "") {
    $errors['naam'] = 'De Email mag niet leeg zijn';
}

// this error message wil overwrite the previous error when date is empty
if ($datum == "") {
    $errors['datum'] = 'De Datum mag niet leeg zijn';
}
if (!is_numeric($telefoonnummer)) {
    $errors['telefoonnummer'] = 'telefoonnummer moet een nummer zijn';
}
if ($telefoonnummer < 11) {
    $errors['telefoonnummer'] = 'minimaal 10 nummers';
}
// this error message wil overwrite the previous error when time is empty
if ($telefoonnummer == "") {
    $errors['telefoonnummer'] = 'De telefoonnummer mag niet leeg zijn';
}
