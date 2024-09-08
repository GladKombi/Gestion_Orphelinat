<?php
include '../connexion/connexion.php';
require_once('../models/select/select-don.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Don</title>
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
                        <h4 class="text-white">Les Dons</h4>
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
                    if (isset($_GET['AjoutDon']) && isset($_GET['IdCategorie'])|| isset($_GET['Modifier'])) {
                        $categorie = $_GET['IdCategorie'];
                        if ($categorie == 1) {
                        ?>
                            <div class="col-xl-12 ">
                                <h4 class="text-center"><?= $title ?></h4>                                
                                <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">Description <span class="text-danger">*</span></label>
                                            <input required type="text" name="description" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idDonNat'])) { ?>
                                                value=<?php echo $tab['description']; ?> <?php } ?>>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">Bienfaitaire <span class="text-danger">*</span></label>
                                            <select required name="bienfaiteur" id="" class="form-control select2">
                                                <?php
                                                $statut = 0;
                                                $rep = $connexion->prepare("SELECT * from `bienfaiteur` WHERE statut=?");
                                                $rep->execute([$statut]);
                                                $Donnateur = "";
                                                while ($Bienfait = $rep->fetch()) {
                                                    $Donnateur = $tab['orientation'];
                                                    if (isset($_GET['idDonNat'])) {
                                                ?>
                                                        <option <?php if ($Bienfait['id'] == $Donnateur) { ?> Selected <?php } ?> value="<?php echo $Bienfait['id']; ?>">
                                                        <?php echo  $Bienfait['nom'] . " " . $Bienfait['postnom'] . " " . $Bienfait['prenom']; ?>
                                                        </option>
                                                    <?php } else {
                                                    ?>
                                                        <option value="<?php echo $Bienfait['id']; ?>">
                                                            <?php echo  $Bienfait['nom'] . " " . $Bienfait['postnom'] . " " . $Bienfait['prenom']; ?>
                                                        </option>
                                                <?php }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                            <input type="submit" name="<?= $btn ?>" class="btn btn-success w-100" value="<?= $btn ?>">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php
                        }else{
                            ?>
                                <div class="col-xl-12 ">
                                    <h4 class="text-center"><?= $title ?></h4>
                                    <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="">Description <span class="text-danger">*</span></label>
                                                <input required type="text" name="description" class="form-control" placeholder="Entrez la description" <?php if (isset($_GET['idDonNum'])) { ?>
                                                    value=<?php echo $tab['description']; ?> <?php } ?>>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="">Bienfaitaire <span class="text-danger">*</span></label>
                                                <select required name="bienfaiteur" id="" class="form-control select2">
                                                    <?php
                                                    $statut = 0;
                                                    $rep = $connexion->prepare("SELECT * from `bienfaiteur` WHERE statut=?");
                                                    $rep->execute([$statut]);
                                                    $Donnateur = "";
                                                    while ($Bienfait = $rep->fetch()) {
                                                        $Donnateur = $tab['orientation'];
                                                        if (isset($_GET['idClass'])) {
                                                    ?>
                                                            <option <?php if ($Bienfait['id'] == $Donnateur) { ?> Selected <?php } ?> value="<?php echo $Bienfait['id']; ?>">
                                                            <?php echo  $Bienfait['nom'] . " " . $Bienfait['postnom'] . " " . $Bienfait['prenom']; ?>
                                                            </option>
                                                        <?php } else {
                                                        ?>
                                                            <option value="<?php echo $Bienfait['id']; ?>">
                                                                <?php echo  $Bienfait['nom'] . " " . $Bienfait['postnom'] . " " . $Bienfait['prenom']; ?>
                                                            </option>
                                                    <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="">Montant <span class="text-danger">*</span></label>
                                                <input required type="text" name="montant" class="form-control" placeholder="Entrez le montant" <?php if (isset($_GET['idDonNum'])) { ?>
                                                    value=<?php echo $tab['montant']; ?> <?php } ?>>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="">Devise <span class="text-danger">*</span></label>
                                                <select required id="" name="devise" class="form-control select2">
                                                    <?php if (isset($_GET['idDonNum'])) {
                                                        $devise = $tab['devise'];
                                                    ?>
                                                        <option value="Dollards">Dollards</option>
                                                        <option <?php if ($devise == "CDF") { ?> Selected <?php } ?>value="CDF">CDF</option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option desabled>Choisir une devise</option>
                                                        <option value="CDF">CDF</option>
                                                        <option value="Dollards">Dollards</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
    
                                            <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                                <input type="submit" name="<?= $btn ?>" class="btn btn-success w-100" value="<?= $btn ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php
                            }
                    } else {
                        if (isset($_GET['AjoutDon'])) {
                        ?>
                            <div class="col-xl-12 pt-3">
                                <div class="card pt-4 shadow">
                                    <h4 class="text-center">Les categoriede dons</h4>
                                    <div class="card-header">
                                        <h4 class="text-center" hidden>Les categoriede dons</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary" href="#"><i class="fas fa-minus">Choisir</i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="mycard-collapse">
                                        <div class="card-body text-center">
                                            <a href="don.php?AjoutDon&IdCategorie=1" class="btn btn-success">Enregistrer Don en Nature</a>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="don.php?AjoutDon&IdCategorie=2" class="btn btn-success">Enregistrer Don en Numeraire</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-xl-12 mb-3 mt-3 ">
                                <a href="don.php?AjoutDon" class="btn btn-success w-100">Enregistrer Nouveau don</a>
                            </div>
                    <?php
                        }
                    }


                    ?>
                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center pt-3">Les dons en nature</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>
                                    <th>Bienfaitaire</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idDonNat = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $idDonNat["date"] ?></td>
                                        <td><?= $idDonNat["nom"] . " " . $idDonNat["postnom"] . " " . $idDonNat["prenom"] ?></td>
                                        <td><?= $idDonNat["description"] ?></td>                                        
                                        <td>
                                            <a href="don.php?AjoutDon&IdCategorie=1&idDonNat=<?= $idDonNat['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-don-post.php?idSupEnf=<?= $idDonNat['id'] ?>" class="btn btn-danger btn-sm mt-1">
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
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center pt-3">Les dons en Numeraire</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>
                                    <th>Bienfaitaire</th>
                                    <th>Description</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idDonNum = $getDon->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $idDonNum["date"] ?></td>
                                        <td><?= $idDonNum["nom"] . " " . $idDonNum["postnom"] . " " . $idDonNum["prenom"] ?></td>
                                        <td><?= $idDonNum["description"] ?></td>    
                                        <td><?= $idDonNum["montant"]. " " . $idDonNum["devise"]?></td>                                      
                                        <td>
                                            <a href="don.php?AjoutDon&IdCategorie=2&idDonNum=<?= $idDonNum['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-enfant-post.php?idSupEnf=<?= $idDonNum['id'] ?>" class="btn btn-danger btn-sm mt-1">
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