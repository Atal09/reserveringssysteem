<?php
// Start de sessie
session_start();
// Vernietig de sessie
session_destroy();

// Stuur door naar de login pagina
header('Location: login.php');
// Stop de code
exit;