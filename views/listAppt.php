<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="title_add-patient_page py-5">Liste des rendez-vous</h1>
            </div>
        </div>
        <div class="container table-responsive py-3">
            <table class="table table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Fiche RDV</th>
                        <th>Delete RDV</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Appointments as $Appointment) : ?>
                        <tr>
                            <td><?= $Appointment->lastname ?></td>
                            <td><?= $Appointment->firstname ?></td>
                            <td><?= date('d/m/Y', strtotime($Appointment->dateHour)) ?></td>
                            <td><?= date('H:i', strtotime($Appointment->dateHour)) ?></td>
                            <td><a href="/profil-RDV?id=<?= $Appointment->idAppt ?>"><img src="/public/assets/img/eye.png" alt="un oeil"></a></td>
                            <td><a href="/supprimer-RDV?id=<?= $Appointment->idAppt ?>"><img src="/public/assets/img/poubelle.png" alt="une poubelle"></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="text-center pt-3">
            <a href="/ajout-RDV">
                <button type="button" class="btn">Ajouter un nouveau rendez-vous</button>
            </a>
        </div>
    </div>
</main>