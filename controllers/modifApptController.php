<?php
// Variable CSS
$formPage = 'form.css';

// Appel du model "Appointment"
require_once(dirname(__FILE__) . '/../models/Appointment.php');
require_once(dirname(__FILE__) . '/../models/Patient.php');

// Appel de la regex
require_once(dirname(__FILE__) . '/../config/constante.php');

// Variable pour le titre
$title = 'Modifier le rendez-vous';

$patients = Patient::listPatient();

$idAppt = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$result = Appointment::getOneById($idAppt);

// Tableau d'erreur
$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verification patient ("VALIDE")
    $patient = trim(filter_input(INPUT_POST, 'patient', FILTER_SANITIZE_NUMBER_INT));
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

    $dateHour = $date . ' ' . $time;

    // Pour modifier le rdv
    if (empty($error)) {

        $appointment = new Appointment($dateHour, $patient);
        $updateAppt = $appointment->modifAppt($idAppt);

        if ($updateAppt === true) {
            $error['addAppt'] = 'Le rendez-vous a bien été modifié';
            $className['addAppt'] = 'success';
        } else {
            $error['addAppt'] = "Le rendez-vous n'a pas pu être modifié";
            $className['addAppt'] = 'error';
        }
    }
}

$result = Appointment::getOneById($idAppt);

// Appel de la page "Ajout RDV"
include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/addAppointment.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
