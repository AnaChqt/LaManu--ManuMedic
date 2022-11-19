<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="title_add-patient_page py-5">Liste des patients</h1>
            </div>
        </div>
        <div class="container table-responsive py-3">
            <form action="" method=POST class="pb-3 d-flex justify-content-end">
                <input type="search" placeholder="Rechercher un patient" name="search" value="<?= $search ?? '' ?>" class="me-2">
                <input type="submit" value="rechercher">
            </form>
            <table class="table table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Phone</th>
                        <th>Mail</th>
                        <th>Fiche Patient</th>
                        <th>Delete Patient</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient) : ?>
                        <tr>
                            <td><?= $patient->lastname ?></td>
                            <td><?= $patient->firstname ?></td>
                            <td><a href="tel: <?= $patient->phone ?>"><?= $patient->phone ?></a></td>
                            <td><a href="mailto: <?= $patient->mail ?> "><?= $patient->mail ?></a></td>
                            <td><a href="/profil-patient?id=<?= $patient->id ?>"><img src="/public/assets/img/eye.png" alt=""></a></td>
                            <td><a href="/supprimer-patient-RDV?id=<?= $patient->id ?>"><img src="/public/assets/img/poubelle.png" alt=""></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="text-center pb-3">
            <?php for ($i = 0; $i < $nbPages; $i++) { ?>
                <a href="/liste-patient?page=<?= $i + 1 ?>">
                    <button type="button" class="btn"><?= $i + 1 ?></button>
                </a>
            <?php } ?>
        </div>
        <div class="text-center pt-3">
            <a href="/ajout-patient">
                <button type="button" class="btn">Ajouter un nouveau patient</button>
            </a>
        </div>
    </div>
</main>