<?php
// Variable CSS
$profilPatientPage = 'profilPatient.css';

require_once(dirname(__FILE__) . '/../models/Patient.php');
require_once(dirname(__FILE__) . '/../models/Appointment.php');

$idPatient = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

$idProfil = Patient::findId($idPatient);
if ($idProfil instanceof PDOException) {
    $messageError =  $idProfil->getMessage();
}

$appointment = new Appointment('', $idPatient);

$allApptById = $appointment->getAllApptById();

include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/profilPatient.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
