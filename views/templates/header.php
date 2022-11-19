<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link rel="stylesheet" href="/public/assets/css/<?= $formPage ?? '' ?>">
    <link rel="stylesheet" href="/public/assets/css/<?= $listPatientPage ?? '' ?>">
    <link rel="stylesheet" href="/public/assets/css/<?= $profilPatientPage ?? '' ?>">

    <link rel="shortcut icon" href="/public/assets/img/manuMédic.png" type="image/x-icon">

    <title>Hospital</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand py-2 ps-4 fw-bold fs-2" href="/accueil">MANU MÉDIC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav text-center fw-bold">
                        <li class="nav-item">
                            <a class="nav-link pe-3" href="/ajout-patient">Ajouter un nouveau patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pe-3" href="/liste-patient">Liste des patients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pe-3" href="/ajout-RDV">Ajouter un rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pe-3" href="/liste-RDV">Liste des rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pe-3" href="/ajout-patient-RDV">Ajouter un patient et un rendez-vous</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>