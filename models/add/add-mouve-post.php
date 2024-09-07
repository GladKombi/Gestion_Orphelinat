<?php
include('../../connexion/connexion.php');
$categories = $_GET['IdCategorie'];
if ($categories == 1) {
    $categorie = "Entree";
} else {
    $categorie = "Sortie";
}
if (isset($_POST['EnregistrerEntre'])) {
    $typeMouv = $categorie;
    $description = htmlspecialchars($_POST['description']);
    $montant = htmlspecialchars($_POST['montant']);
    $devise = htmlspecialchars($_POST['devise']);
    $aujourd_hui = date("Y-m-d");
    $statut = 0;
    # Insertion of data into the DB
    if (!empty($description) && !empty($montant)) {
        $req = $connexion->prepare("INSERT INTO `mouvementcaisse`(`date`, `description`, `Montant`, `devise`, `type`, `statut`) VALUES (?,?,?,?,?,?)");
        $resultat = $req->execute([$aujourd_hui, $description, $montant, $devise, $typeMouv, $statut]);
        if ($resultat == true) {
            $_SESSION['msg'] = "Un enregistrement viens d'etre effectué !";
            header("location:../../views/movementCaisse.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/movementCaisse.php");
        }
    } else {
        $_SESSION['msg'] = "Veillez complté tous les champs !";
        header("location:../../views/movementCaisse.php");
    }
} elseif (isset($_POST['EnregistrerSortie'])) {
    $typeMouv = $categorie;
    $description = htmlspecialchars($_POST['description']);
    $montant = htmlspecialchars($_POST['montant']);
    $devise = htmlspecialchars($_POST['devise']);
    $aujourd_hui = date("Y-m-d");
    $statut = 0;
    # Insertion of data into the DB
    if (!empty($description) && !empty($montant)) {
        $Ent = "Entree";
        $getDataMod = $connexion->prepare("SELECT SUM(`Montant`) as MontantEncais FROM `mouvementcaisse`WHERE mouvementcaisse.type=? and devise=?;");
        $getDataMod->execute([$Ent, $devise]);
        $tab = $getDataMod->fetch();
        $montantEnC = $tab['MontantEncais'];
        if ($montant > $montantEnC) {
            $_SESSION['msg'] = "le montant saisi est superieur en celui en caisse !";
            header("location:../../views/movementCaisse.php");
        } else {
            $req = $connexion->prepare("INSERT INTO `mouvementcaisse`(`date`, `description`, `Montant`, `devise`, `type`, `statut`) VALUES (?,?,?,?,?,?)");
            $resultat = $req->execute([$aujourd_hui, $description, $montant, $devise, $typeMouv, $statut]);
            if ($resultat == true) {
                $_SESSION['msg'] = "Un enregistrement viens d'etre effectué !";
                header("location:../../views/movementCaisse.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement !";
                header("location:../../views/movementCaisse.php");
            }
        }
    } else {
        $_SESSION['msg'] = "Veillez complté tous les champs !";
        header("location:../../views/movementCaisse.php");
    }
} else {
    header('location:../../views/movementCaisse.php');
}
