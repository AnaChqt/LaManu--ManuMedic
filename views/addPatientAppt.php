    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="py-5"><?= $title ?></h1>
                    <p class="<?= $className['addPatient'] ?>"><?= $error['addPatient'] ?? '' ?></p>
                </div>
            </div>
            <div class="row ps-5 pe-5">
                <form action="<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <div class="card">

                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <label for="lastname" class="fw-bold">Nom*</label>
                                <input name="lastname" type="text" value="<?= $idProfil->lastname ?? $lastname ?? '' ?>" required pattern="<?= REGEX_NAME ?>" class="form-control" id="lastname" placeholder="Entrez un nom">
                                <p class="erreur"><?= $error['lastname'] ?? '' ?></p>
                            </div>

                            <div class="col-md-4">
                                <label for="firstname" class="fw-bold">Prénom*</label>
                                <input name="firstname" type="text" value="<?= $idProfil->firstname ?? $firstname ?? '' ?>" required pattern="<?= REGEX_NAME ?>" class="form-control" id="firstname" placeholder="Entrez un prénom">
                                <p class="erreur"><?= $error['firstname'] ?? '' ?></p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <label for="birthdate" class="fw-bold">Date de naissance*</label>
                                <input name="birthdate" type="date" value="<?= $idProfil->birthdate ?? $birthdate ?? '' ?>" required class="form-control" id="birthdate" min="1900-01-01">
                                <p class="erreur"><?= $error['birthdate'] ?? '' ?></p>
                            </div>

                            <div class="col-md-4">
                                <label for="phone" class="fw-bold">Téléphone</label>
                                <input name="phone" type="tel" value="<?= $idProfil->phone ?? $phone ?? '' ?>" pattern="<?= REGEX_PHONE ?>" class="form-control" id="phone" min="10" max="10" placeholder="Téléphone">
                                <p class="erreur"><?= $error['phone'] ?? '' ?></p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <label for="mail" class="fw-bold">Email*</label>
                                <input name="mail" type="email" value="<?= $idProfil->mail ?? $mail ?? '' ?>" required class="form-control" id="mail" placeholder="Email">
                                <p class="erreur"><?= $error['mail'] ?? '' ?></p>
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
                            <button type="submit" class="btn text-center">Ajouter le patient et le rendez-vous</button>
                            <p class="pt-3 fw-bold">* Informations obligatoires</p>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </main>