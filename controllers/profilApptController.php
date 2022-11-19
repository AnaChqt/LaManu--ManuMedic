<?php
require_once(dirname(__FILE__) . '/../models/Appointment.php');

// Variable CSS
$profilPatientPage = 'profilPatient.css';



$id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

$result = Appointment::getOneById($id);
if ($result instanceof PDOException) {
    $messageError =  $result->getMessage();
}

include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/profilAppt.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
