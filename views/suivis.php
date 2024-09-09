<?php
## Se connecter à la BD
include '../connexion/connexion.php';
## Selction Script
require_once('../models/select/select-Suivis.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Suivis</title>
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
                        <h4 class="text-white">Suivis des enfants</h4>
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
                    if (isset($_GET['AjoutSuis'])) {
                    ?>
                        <div class="col-xl-12 ">
                            <h4 class="text-center"><?= $title ?></h4>
                            <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <div class="row">
                                <?php
                                    if((isset($_GET['idSuivis']))){
                                    ?>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Constant <span class="text-danger">*</span></label>
                                        <input required type="text" name="constant" class="form-control" placeholder="Entrez ici le constant" <?php if (isset($_GET['idSuivis'])) { ?>
                                            value=<?php echo $tab['constation']; ?> <?php } ?>>
                                    </div>
                                    <?php }else {?>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Adoption <span class="text-danger">*</span></label>
                                        <select required name="adoption" id="" class="form-control select2">
                                            <?php
                                            $statut = 0;
                                            $rep = $connexion->prepare("SELECT adoption.*, enfant.nom, enfant.postnom from `adoption`, enfant WHERE adoption.enfant=enfant.id and adoption.statut=?");
                                            $rep->execute([$statut]);
                                            $adopxion = "";
                                            while ($Adoption = $rep->fetch()) {
                                                $adopxion = $tab['adoption'];
                                                if (isset($_GET['etetr'])) {
                                            ?>
                                                    <option <?php if ($Adoption['id'] == $adopxion) { ?> Selected <?php } ?> value="<?php echo $Adoption['id']; ?>">
                                                    <?php echo  $Adoption['id'] . ". " .$Adoption['date'] . "   L'enfant: " . $Adoption['nom'] . " " . $Adoption['postnom']; ?>
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
                            <a href="suivis.php?AjoutSuis" class="btn btn-success w-100">Ajouter un costant</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center pt-3">Liste des Constants</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>                                    
                                    <th>Noms de l'enfant</th>
                                    <th>Profil de enfant</th>
                                    <th>Tuteur</th>
                                    <th>Constant</th>                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idSuivis = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $idSuivis["date"] ?></td>                                        
                                        <td><?= $idSuivis["nom"] . " " . $idSuivis["postnom"] . " " . $idSuivis["prenom"] ?></td>
                                        <td>
                                            <img src="../photo/<?= $idSuivis["photo"] ?>" class="rounded-circle mt-2" width="60px" height="55px" alt="">
                                        </td>
                                        <td><?= $idSuivis["nomtutaire"]. " " . $idSuivis["prenomTutare"] ?></td>
                                        <td><?= $idSuivis["constation"] ?></td>
                                        <td>
                                            <a href="suivis.php?AjoutSuis&idSuivis=<?= $idSuivis['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-enfant-post.php?idSupEnf=<?= $idSuivis['id'] ?>" class="btn btn-danger btn-sm mt-1">
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