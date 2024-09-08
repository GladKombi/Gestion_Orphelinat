<?php
include '../connexion/connexion.php'; //Se connecter à la BD
require_once('../models/select/select-Bienfaiteur.php'); //Appel du script de selection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Bienfaiteur</title>
    <?php require_once('style.php') ?>

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <?php require_once('navbar.php') ?>
            <div class="main-sidebar sidebar-style-2">
                <?php require_once('aside.php') ?>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-white">Bienfaiteur</h4>
                    </div>
                    <!-- pour afficher les massage  -->
                    <?php
                    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                        <div class="col-xl-12 mt-3">
                            <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                        </div>
                    <?php }
                    #Cette ligne permet de vider la valeur qui se trouve dans la session message
                    unset($_SESSION['msg']);
                    ?>
                    <!-- Le form qui enregistrer les données  -->
                    <?php
                    if (isset($_GET['AjoutBien'])) {
                    ?>
                        <div class="col-xl-12 ">
                            <h4 class="text-center"><?= $title ?></h4>
                            <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Nom <span class="text-danger">*</span></label>
                                        <input required type="text" name="nom" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idBienfait'])) { ?>
                                            value=<?php echo $tab['nom']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Postnom <span class="text-danger">*</span></label>
                                        <input required type="text" name="postnom" class="form-control" placeholder="Entrez le postnom" <?php if (isset($_GET['idBienfait'])) { ?>
                                            value=<?php echo $tab['postnom']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Prenom <span class="text-danger">*</span></label>
                                        <input required type="text" name="prenom" class="form-control" placeholder="Entrez le prenom" <?php if (isset($_GET['idBienfait'])) { ?>
                                            value=<?php echo $tab['prenom']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Genre <span class="text-danger">*</span></label>
                                        <select required id="" name="genre" class="form-control select2">
                                            <?php if (isset($_GET['idBienfait'])) {
                                                $genre = $tab['genre'];
                                            ?>
                                                <option value="Masculin">Masculin</option>
                                                <option <?php if ($genre == "Feminin") { ?> Selected <?php } ?>value="Feminin">Feminin</option>
                                            <?php
                                            } else {
                                            ?>
                                                <option desabled>Choisir un genre</option>
                                                <option value="Masculin">Masculin</option>
                                                <option value="Feminin">Feminin</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Adresse <span class="text-danger">*</span></label>
                                        <input required type="text" name="adresse" class="form-control" placeholder="Entrez le adresse" <?php if (isset($_GET['idBienfait'])) { ?>
                                            value=<?php echo $tab['adresse']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Numero telephone <span class="text-danger">*</span></label>
                                        <input required type="text" name="telephone" class="form-control" placeholder="Entrez votre numero" <?php if (isset($_GET['idBienfait'])) { ?>
                                            value=<?php echo $tab['telephone']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Adresse mail <span class="text-danger">*</span></label>
                                        <input required type="mail" name="mail" class="form-control" placeholder="Entrez le mail" <?php if (isset($_GET['idBienfait'])) { ?>
                                            value=<?php echo $tab['mail']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                        <input type="submit" name="Valider" class="btn btn-success w-100" value="<?= $btn ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-xl-12 mb-3 mt-3 ">
                            <a href="Bienfaiteur.php?AjoutBien" class="btn btn-success w-100">Ajouter Bienfaiteur</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center pt-3">Liste des Bienfaiteurs</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Noms</th>
                                    <th>Genre</th>
                                    <th>Adresse</th>
                                    <th>Telephone</th>
                                    <th>Mail</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idBienfait = $getData->fetch()) {
                                    $n++;                                   
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $idBienfait["nom"] . " " . $idBienfait["postnom"] . " " . $idBienfait["prenom"] ?></td>
                                        <td><?= $idBienfait["genre"] ?></td>
                                        <td><?= $idBienfait["adresse"] ?></td>
                                        <td><?= $idBienfait["telephone"] ?></td>
                                        <td><?= $idBienfait["mail"] ?></td>                                        
                                        <td>
                                            <a href="Bienfaiteur.php?AjoutBien&idBienfait=<?= $idBienfait['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-bienfaiteur-post.php?idSupEnf=<?= $idBienfait['id'] ?>" class="btn btn-danger btn-sm mt-1">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php require_once('footer.php') ?>
        </div>
    </div>

    <?php require_once('script.php') ?>
</body>

</html>