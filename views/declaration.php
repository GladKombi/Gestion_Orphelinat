<?php
## Se connecter à la BD
include '../connexion/connexion.php';
## Selction Script
require_once('../models/select/select-declaration.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Declaration</title>
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
                        <h4 class="text-white">Declaration</h4>
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
                    if (isset($_GET['AjoutDec']) || isset(($_GET['idDclara']))) {
                    ?>
                        <div class="col-xl-12 ">
                            <h4 class="text-center"><?= $title ?></h4>
                            <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <div class="row">
                                <?php
                               if (isset($_GET['idDclara'])) {
                                ?>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Note <span class="text-danger">*</span></label>
                                        <input required type="text" name="note" class="form-control" placeholder="Entrez une note" <?php if (isset($_GET['idDclara'])) { ?>
                                            value=<?php echo $tab['description']; ?> <?php } ?>>
                                    </div>
                                    <?php }else{?>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Adoption <span class="text-danger">*</span></label>
                                        <select required name="adoption" id="" class="form-control select2">
                                            <?php
                                            $statut = 0;
                                            $rep = $connexion->prepare("SELECT adoption.*, enfant.nom, enfant.postnom from `adoption`, enfant WHERE adoption.enfant=enfant.id and adoption.statut=?");
                                            $rep->execute([$statut]);
                                            $Donnateur = "";
                                            while ($Adoption = $rep->fetch()) {
                                                $Donnateur = $tab['orientation'];
                                                if (isset($_GET['idClass'])) {
                                            ?>
                                                    <option <?php if ($Adoption['id'] == $Donnateur) { ?> Selected <?php } ?> value="<?php echo $Adoption['id']; ?>">
                                                        <?php echo  $Adoption['Description']; ?>
                                                    </option>
                                                <?php } else {
                                                ?>
                                                    <option value="<?php echo $Adoption['id']; ?>">
                                                        <?php echo  $Adoption['id'] . ". " .$Adoption['date'] . "   L'enfant: " . $Adoption['nom'] . " " . $Adoption['postnom']; ?>
                                                    </option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div> 
                                    <?php }?>                                 
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
                            <a href="declaration.php?AjoutDec" class="btn btn-success w-100">Ajouter declaration</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center pt-3">Liste des declations</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>
                                    <th>Note</th>
                                    <th>Noms de l'enfant</th>
                                    <th>Profil</th>
                                    <th>Identité Tuteur</th>                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idDclara = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $idDclara["date"] ?></td>
                                        <td><?= $idDclara["description"] ?></td>
                                        <td><?= $idDclara["nom"] . " " . $idDclara["postnom"] . " " . $idDclara["prenom"] ?></td>
                                        <td>
                                            <img src="../photo/<?= $idDclara["photo"] ?>" class="rounded-circle mt-2" width="60px" height="55px" alt="">
                                        </td>
                                        <td><?= $idDclara["nomtutaire"] . " " . $idDclara["prenomTutare"] ?></td>
                                        <td>
                                            <a href="declaration.php?idDclara=<?= $idDclara['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-enfant-post.php?idSupEnf=<?= $idDclara['id'] ?>" class="btn btn-danger btn-sm mt-1">
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