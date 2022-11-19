    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="py-5"><?= $title ?></h1>
                    <p class="<?= $className['addAppt'] ?>"><?= $error['addAppt'] ?? '' ?></p>
                </div>
            </div>
            <div class="row ps-5 pe-5">
                <?php
                if (isset($messageError)) {
                    echo $messageError;
                } else { ?>
                    <form action="<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <label for="patient" class="fw-bold">Choix du patient*</label>
                                    <select class="form-select" aria-label="Default select example" name="patient" required>
                                        <option value="">Selectionnez un patient</option>
                                        <?php foreach ($patients as $patient) : ?>
                                            <option value="<?= $patient->id ?>" <?php if (isset($patient) && isset($result)) { ?> <?= $patient->id == $result->idPatients ? "selected" : null ?><?php } ?>><?= $patient->lastname ?? $result->lastname ?? '' ?> <?= $patient->firstname ?? $result->firstname ?? '' ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <p class="erreur"><?= $error['patient'] ?? '' ?></p>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <label for="date" class="fw-bold">Choisir une date*</label>
                                    <input name="date" type="date" value="<?= $idProfil->date ?? date('Y-m-d', strtotime($result->dateHour)) ?? '' ?>" required class="form-control" id="date" min="<?= date('Y-m-d') ?>">
                                    <p class="erreur"><?= $error['date'] ?? '' ?></p>
                                </div>

                                <div class="col-md-4">
                                    <label for="time" class="fw-bold">Choisir un horaire* (Ouvert de 7h30 à 20h)</label>
                                    <input name="time" type="time" step="900" required value="<?= $idProfil->time ?? date('H:i', strtotime($result->dateHour)) ?? '' ?>" pattern="<?= REGEX_TIME ?>" class="form-control" id="time" min="7:30" max="20:00">
                                    <p class="erreur"><?= $error['time'] ?? '' ?></p>
                                </div>
                            </div>

                            <div class="form-group text-center col-md-12">
                                <button type="submit" class="btn text-center">Ajouter le rendez-vous</button>
                                <p class="pt-3 fw-bold">* Informations obligatoires</p>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </main>