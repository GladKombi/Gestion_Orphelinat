<?php
include('../../connexion/connexion.php');
$categories = $_GET['IdCategorie'];
if ($categories == 1) {
    $categorie = "Nature";
} else {
    $categorie = "Numeraire";
}
if (isset($_POST['EnregistrerNat'])) {
    $catDon = $categorie;
    $description = htmlspecialchars($_POST['description']);
    $bienfaiteur = htmlspecialchars($_POST['bienfaiteur']);
    $aujourd_hui = date("Y-m-d");
    $devise="Null";
    $montant=0;
    $statut = 0;
    # Insertion of data into the DB
    if (!empty($description) && !empty($bienfaiteur)) {
        $req = $connexion->prepare("INSERT INTO `don`(`date`, `bienfaiteur`, `description`, `categorie`, `montant`, `devise`, `statut`) VALUES (?,?,?,?,?,?,?)");
        $resultat = $req->execute([$aujourd_hui, $bienfaiteur, $description, $catDon, $montant, $devise, $statut]);
        if ($resultat == true) {
            $_SESSION['msg'] = "Un enregistrement viens d'etre effectué !";
            header("location:../../views/don.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/don.php");
        }
    } else {
        $_SESSION['msg'] = "Veillez complté tous les champs !";
        header("location:../../views/don.php");
    }
} elseif(isset($_POST['EnregistrerNum'])) {
    $catDon = $categorie;
    $description = htmlspecialchars($_POST['description']);
    $bienfaiteur = htmlspecialchars($_POST['bienfaiteur']);
    $aujourd_hui = date("Y-m-d");
    $devise=htmlspecialchars($_POST['devise']);
    $montant=htmlspecialchars($_POST['montant']);
    $statut = 0;
    # Insertion of data into the DB
    if (!empty($description) && !empty($bienfaiteur)) {
        $req = $connexion->prepare("INSERT INTO `don`(`date`, `bienfaiteur`, `description`, `categorie`, `montant`, `devise`, `statut`) VALUES (?,?,?,?,?,?,?)");
        $resultat = $req->execute([$aujourd_hui, $bienfaiteur, $description, $catDon, $montant, $devise, $statut]);
        if ($resultat == true) {
            $_SESSION['msg'] = "Un enregistrement viens d'etre effectué !";
            header("location:../../views/don.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/don.php");
        }
    } else {
        $_SESSION['msg'] = "Veillez complté tous les champs !";
        header("location:../../views/don.php");
    }
} else{
    header('location:../../views/don.php');
}
