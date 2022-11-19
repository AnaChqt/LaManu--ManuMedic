<?php
require_once(dirname(__FILE__) . '/../models/Patient.php');
require_once(dirname(__FILE__) . '/../models/Appointment.php');
require_once(dirname(__FILE__) . '/../config/constante.php');

if (!empty($_GET)) {
    $idAppt = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
    if (Appointment::deleteByPatient($idAppt)) {
        $patient = new Patient();
        $patient->deleteApptPatient($idAppt);
    }
    header('location: /liste-patient');
    die;
}
