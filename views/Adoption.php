<?php
## Se connecter à la BD
include '../connexion/connexion.php';
## Selction Script
require_once('../models/select/select-Adoption.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Adoption</title>
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
                        <h4 class="text-white">Adoption</h4>
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
                    if (isset($_GET['AjoutAdop'])) {
                    ?>
                        <div class="col-xl-12 ">
                            <h4 class="text-center"><?= $title ?></h4>
                            <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Note <span class="text-danger">*</span></label>
                                        <input required type="text" name="note" class="form-control" placeholder="Entrez le notes" <?php if (isset($_GET['idEnfant'])) { ?>
                                            value=<?php echo $tab['prenom']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Enfant <span class="text-danger">*</span></label>
                                        <select required name="enfant" id="" class="form-control select2">
                                            <?php
                                            $statut = 0;
                                            $adopt=0;
                                            $rep = $connexion->prepare("SELECT * from `enfant` WHERE statut=? and adopt=?;");
                                            $rep->execute([$statut, $adopt]);
                                            $Donnateur = "";
                                            while ($Enfant = $rep->fetch()) {
                                                $Donnateur = $tab['orientation'];
                                                if (isset($_GET['idClass'])) {
                                            ?>
                                                    <option <?php if ($Enfant['id'] == $Donnateur) { ?> Selected <?php } ?> value="<?php echo $Enfant['id']; ?>">
                                                        <?php echo  $Enfant['Description']; ?>
                                                    </option>
                                                <?php } else {
                                                ?>
                                                    <option value="<?php echo $Enfant['id']; ?>">
                                                        <?php echo  $Enfant['nom'] . " " . $Enfant['postnom'] . " " . $Enfant['prenom']; ?>
                                                    </option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Tuteur <span class="text-danger">*</span></label>
                                        <select required name="tuteur" id="" class="form-control select2">
                                            <?php
                                            $statut = 0;
                                            $rep = $connexion->prepare("SELECT * from `tuteur` WHERE statut=?");
                                            $rep->execute([$statut]);
                                            $Donnateur = "";
                                            while ($Tuteur = $rep->fetch()) {
                                                $Donnateur = $tab['orientation'];
                                                if (isset($_GET['idClass'])) {
                                            ?>
                                                    <option <?php if ($Tuteur['id'] == $Donnateur) { ?> Selected <?php } ?> value="<?php echo $Tuteur['id']; ?>">
                                                        <?php echo  $Tuteur['Description']; ?>
                                                    </option>
                                                <?php } else {
                                                ?>
                                                    <option value="<?php echo $Tuteur['id']; ?>">
                                                        <?php echo  $Tuteur['nom'] . " " . $Tuteur['postnom'] . " " . $Tuteur['prenom']; ?>
                                                    </option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
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
                            <a href="Adoption.php?AjoutAdop" class="btn btn-success w-100">Ajouter Adoption</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center pt-3">Liste des Adoptions</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>
                                    <th>Note</th>
                                    <th>Noms de l'enfant</th>
                                    <th>Profil de l'enfant</th>
                                    <th>Identité Tuteur</th>                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idAdoption = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $idAdoption["date"] ?></td>
                                        <td><?= $idAdoption["note"] ?></td>
                                        <td><?= $idAdoption["nom"] . " " . $idAdoption["postnom"] . " " . $idAdoption["prenom"] ?></td>
                                        <td>
                                            <img src="../photo/<?= $idAdoption["photo"] ?>" class="rounded-circle mt-2" width="60px" height="55px" alt="">
                                        </td>
                                        <td><?= $idAdoption["nomtutaire"] . " " . $idAdoption["prenomTutare"] ?></td>
                                        <td>
                                            <a href="Adoption.php?AjoutBien&idAdoption=<?= $idAdoption['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-enfant-post.php?idSupEnf=<?= $idAdoption['id'] ?>" class="btn btn-danger btn-sm mt-1">
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