<?php
// Variable CSS
$formPage = 'form.css';

// appel des REGEX
require_once(dirname(__FILE__) . '/../config/constante.php');

// appel du model
require_once(dirname(__FILE__) . '/../models/Patient.php');

// Variable pour le titre
$title = 'Créer un nouveau patient';

// Tableau d'erreur
$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verification lastname ("VALIDE")
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($lastname)) {
        $error['lastname'] = '! Veuillez renseigner votre nom de famille !';
    } else {
        $checkLastname = filter_var(
            $lastname,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => '/' . REGEX_NAME . '/'))
        );
        if ($checkLastname === false) {
            $error['lastname'] = '! Veuillez entrer un nom valide !';
        }
    }

    // Verification firstname ("VALIDE")
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($firstname)) {
        $error['firstname'] = '! Veuillez renseigner votre prénom !';
    } else {
        $checkFirstname = filter_var(
            $firstname,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => '/' . REGEX_NAME . '/'))
        );
        if ($checkFirstname === false) {
            $error['firstname'] = '! Veuillez entrer un prénom valide !';
        }
    }

    // verification date of birth ("VALIDE")
    $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT);
    if (empty($birthdate)) {
        $error['birthdate'] = '! Veuillez renseigner votre date de naissance !';
    } else {
        $checkBirthDate = filter_var(
            $birthdate,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => '/' . REGEX_DATE . '/'))
        );
        if ($checkBirthDate === false) {
            $error['birthdate'] = '! Veuillez entrer une date valide !';
        }
    }

    // verification phone ("VALIDE")
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    if (!empty($phone)) {
        $checkPhone = filter_var(
            $phone,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => '/' . REGEX_PHONE . '/'))
        );
        if ($checkPhone === false) {
            $error['phone'] = '! Veuillez entrer un téléphone valide !';
        }
    }

    // Verification email ("VALIDE")
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL)); //le trim enlève les espaces avant et après
    if (empty($mail)) {
        $error['mail'] = '! Veuillez renseigner votre email !';
    } else {
        $checkMail = filter_var(
            $mail,
            FILTER_VALIDATE_EMAIL,
        );
        if ($checkMail === false) {
            $error['mail'] = '! Veuillez entrer un email valide !';
        }
        if (Patient::isMailExist($mail)) {
            $error['mail'] = '! L\'adresse mail existe déjà !';
        }
    }

    if (empty($error)) {
        $patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail);
        $addPatient = $patient->add();

        if ($addPatient === true) {
            $error['addPatient'] = 'les données ont bien été enregistrées';
            $className['addPatient'] = 'success';
        } else {
            $error['addPatient'] = 'le patient ne peut pas etre enregistré';
            $className['addPatient'] = 'error';
        }
    }
}

// Appel de la page "Ajout Patient"
include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/addPatient.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
