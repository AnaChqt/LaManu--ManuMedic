<?php

require_once(dirname(__FILE__) . '/../config/init.php');
require_once(dirname(__FILE__) . '/../config/constante.php');
require_once(dirname(__FILE__) . '/../utils/database.php');
require_once(dirname(__FILE__) . '/../models/Patient.php');
require_once(dirname(__FILE__) . '/../models/Appointment.php');

// Variable CSS
$formPage = 'form.css';

// Variable pour définir le titre
$title = 'Ajouter un patient et un rendez-vous';

// Tableau d'erreur
$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // verification date ("VALIDE")
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
    if (empty($date)) {
        $error['date'] = '! Veuillez choisir une date !';
    } else {
        $checkDate = filter_var(
            $date,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => '/' . REGEX_DATE . '/'))
        );
        if ($checkDate === false) {
            $error['date'] = '! Veuillez entrer une date valide !';
        }
    }

    // verification time ("VALIDE")
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty($time)) {
        $error['time'] = '! Veuillez choisir un horaire !';
    } else {
        $checkTime = filter_var(
            $time,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => '/' . REGEX_TIME . '/'))
        );
        if ($checkTime === false) {
            $error['time'] = '! Veuillez choisir un horaire valide !';
        }
    }

    // Pour éviter les doublons dans les rdv
    $dateHour = $date . ' ' . $time;
    if (Appointment::isDateExist($dateHour)) {
        $error['time'] = '! L\'horaire est déjà pris !';
    }

    // Pour vérifier si toutes les données du patient sont bien enregistrées
    if (empty($error)) {
        try {
            $pdo = Database::dbConnect();
            $pdo->beginTransaction();
            $patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail);
            $addPatient = $patient->add();

            if ($addPatient != 0) {
                $appointment = new Appointment($dateHour, $addPatient);
                $addAppointment = $appointment->addAppt();

                $pdo->commit();
                $error['addPatient'] = 'les données ont bien été enregistrées';
                $className['addPatient'] = 'success';
            } else {
                $pdo->rollback();
                $error['addPatient'] = 'le patient ne peut pas etre enregistré';
                $className['addPatient'] = 'error';
            }
        } catch (PDOException $e) {
            exit();
        }
    }
}

// Appel de la page "Ajout Patient et RDV"
include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/addPatientAppt.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
