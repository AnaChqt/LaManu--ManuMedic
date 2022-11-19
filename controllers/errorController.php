<?php
require_once(dirname(__FILE__) . '/../config/constante.php');

$error = intval(filter_input(INPUT_GET, 'error', FILTER_SANITIZE_NUMBER_INT));

// Appel de la page "Erreur"
include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/error.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
