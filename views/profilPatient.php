<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="py-5">Profil du patient</h1>
                <h2 class="py-2 fw-bold"><?= $messageError ?? '' ?></h2>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <?php if (empty($messageError)) { ?>
                    <div class="card text-center text-light">
                        <div class="card_title fw-bold py-2">ID PATIENT</div>
                        <div class="card_body py-4 px-5">
                            <p><b class="profil">Lastname : </b><?= $idProfil->lastname ?></p>
                            <p><b class="profil">Firstname : </b><?= $idProfil->firstname ?></p>
                            <p><b class="profil">Birthdate : </b><?= date('d/m/Y', strtotime($idProfil->birthdate)) ?></p>
                            <p><b class="profil">Phone : </b><a href="tel: <?= $idProfil->phone ?>"><?= $idProfil->phone ?></a></p>
                            <p><b class="profil">Mail : </b><a href="mailto: <?= $idProfil->mail ?> "><?= $idProfil->mail ?></a></p>
                            <p><b class="profil text-center">Les Rendez-Vous : </p>
                            <?php foreach ($allApptById as $result) : ?>
                                <p class="text-light"><b class="profil">Date : </b><?= date('d/m/Y', strtotime($result->dateHour)) ?? '' ?></p>
                                <p class="text-light"><b class="profil">Time : </b><?= date('H:i', strtotime($result->dateHour)) ?? '' ?></p>
                            <?php endforeach ?>
                            <div class="text-center pt-3">
                                <a href="/modifier-patient?id=<?= $idProfil->id ?>">
                                    <button type="button" class="btn modif">Modifier les informations</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="text-center pt-4">
                <a href="/liste-patient">
                    <button type="button" class="btn">Retourner sur la liste des patients</button>
                </a>
            </div>
        </div>
    </div>
</main>