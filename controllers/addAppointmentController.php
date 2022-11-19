<?php
require_once(dirname(__FILE__) . '/../config/constante.php');
require_once(dirname(__FILE__) . '/../models/Patient.php');
require_once(dirname(__FILE__) . '/../models/Appointment.php');

$formPage = 'form.css';

$title = 'Ajouter un rendez-vous';

$patients = Patient::listPatient();

// Tableau d'erreur
$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verification patient ("VALIDE")
    $patient = trim(filter_input(INPUT_POST, 'patient', FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($patient)) {
        $error['patient'] = '! Veuillez choisir un patient !';
    } else {
        $checkPatient = filter_var(
            $patient,
            FILTER_VALIDATE_INT,
        );
        if ($checkPatient === false) {
            $error['patient'] = '! Veuillez choisir un patient exixtant !';
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

    // Pour vérifier si le rdv a bien été enregistré 
    if (empty($error)) {
        $appointment = new Appointment($dateHour, $patient);
        $addAppt = $appointment->addAppt();
        if ($addAppt === true) {
            $error['addAppt'] = 'Le rendez-vous a bien été enregistré';
            $className['addAppt'] = 'success';
        } else {
            $error['addAppt'] = "Le rendez-vous n'à pas pu être enregistré";
            $className['addAppt'] = 'error';
        }
    }
}

// Appel de la page "Ajout RDV"
include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/addAppointment.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
