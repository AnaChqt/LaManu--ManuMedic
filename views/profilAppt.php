<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="py-5">Profil du patient et ses rendez-vous</h1>
                <h2 class="py-2 fw-bold"><?= $messageError ?? '' ?></h2>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <?php if (empty($messageError)) { ?>
                    <div class="card text-center text-light">
                        <div class="card_title fw-bold py-2">ID PATIENT</div>
                        <div class="card_body py-4 px-5">
                            <p><b class="profil">Lastname : </b><?= $result->lastname ?? '' ?></p>
                            <p><b class="profil">Firstname : </b><?= $result->firstname ?? '' ?></p>
                            <p><b class="profil">Date : </b><?= date('d/m/Y', strtotime($result->dateHour)) ?? '' ?></p>
                            <p><b class="profil">Heure : </b><?= date('H:i', strtotime($result->dateHour))  ?? '' ?></p>
                            <div class="text-center pt-3">
                                <a href="/modifier-RDV?id=<?= $result->idAppt ?>">
                                    <button type="button" class="btn modif">Modifier les informations</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="text-center pt-4">
                <a href="/liste-RDV">
                    <button type="button" class="btn">Retourner sur la liste des rendez-vous</button>
                </a>
            </div>
        </div>
    </div>
</main>