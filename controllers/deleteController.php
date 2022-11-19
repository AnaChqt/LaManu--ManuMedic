<?php
require_once(dirname(__FILE__) . '/../models/Patient.php');
require_once(dirname(__FILE__) . '/../models/Appointment.php');
require_once(dirname(__FILE__) . '/../config/constante.php');

if (!empty($_GET)) {
    $idAppt = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
    $appointment = new Appointment();
    $appointment->deleteAppt($idAppt);
    header('location: /liste-RDV');
    die;
}
