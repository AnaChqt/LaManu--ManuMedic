    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="py-5"><?= $title ?></h1>
                    <p class="<?= $className['addPatient'] ?>"><?= $error['addPatient'] ?? '' ?></p>
                </div>
            </div>
            <div class="row ps-5 pe-5">
                <!--enctype="multipart/form-data" permet d'envoyer des documents via le formulaire (a placer après la method-->
                <!-- permet de  -->
                <!-- pour le for et l'id on donne le même nom que les attributs et les variables -->
                <!-- dans la base de données, lorsque c'est NULL, ça veut dire que ce n'est pas obligatoire-->
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

                        <div class="form-group text-center col-md-12">
                            <button type="submit" class="btn text-center">Ajouter le patient</button>
                            <p class="pt-3 fw-bold">* Informations obligatoires</p>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </main>