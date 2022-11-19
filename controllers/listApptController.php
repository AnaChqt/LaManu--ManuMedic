<?php
// Variable CSS
$listPatientPage = 'listPatient.css';

require_once(dirname(__FILE__) . '/../models/Appointment.php');

$Appointments = Appointment::listAppt();

// Appel de la page "liste RDV"
include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/listAppt.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
