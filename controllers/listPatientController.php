<?php
// Variable CSS
$listPatientPage = 'listPatient.css';

require_once(dirname(__FILE__) . '/../models/Patient.php');

$patients = Patient::listPatient();

// Pour le champ "search"
if (isset($_POST['search'])) {
    $search = trim(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS));
    $patients = Patient::listPatient($search);
}

// Pour la pagination
if (isset($_GET['page'])) {
    $currentPage = intVal(trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS)));
} else {
    $currentPage = 1;
}

$search = trim(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS));

$nbPatients = Patient::count();
$patientsPerPage = 10;
$nbPages = ceil($nbPatients->nb_patients / $patientsPerPage);
$offset = ($currentPage - 1) * $patientsPerPage;

$patients = Patient::listPatient($search, $patientsPerPage, $offset);

// Appel de la page "liste patient"
include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/listPatient.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
