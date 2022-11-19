<?php
// Permet de définir les pages avec les différentes erreurs
define('ERROR_ARRAY', [
    0 => 'erreur générique',
    1 => 'Vous n\'etes pas connecté à la base de donnée',
    2 => 'erreur 2',
    3 => 'Le patient et le rdv ont été créés',
    4 => 'Erreur lors de la création du patien et du rdv'
]);

// Regex pour le nom et prénom 
define('REGEX_NAME', "^[a-zA-Zïëüÿöçâéèñôáóøšşćĕłăčőřžåķņńžůãşœæę '\-]*$");

// Regex pour la date de naissance et la date
define('REGEX_DATE', "^([0-9]{4})[\/\-]?([0-9]{2})[\/\-]?([0-9]{2})");

// Regex pour le téléphone (Accompagner l'utilisateur pour lui dire comment remplir son numéro de tel)
define('REGEX_PHONE', "^[0-9]{10}");

// Regex pour l'heure des rdv
define('REGEX_TIME', "^[0-9]{2}:[0-9]{2}");
