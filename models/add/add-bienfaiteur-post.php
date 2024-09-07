<?php
include('../../connexion/connexion.php');
# Appel de la fonction qui permet de vefier la date de naissance
require_once('../../fonction/function.php');
if (isset($_POST['Valider'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $adress = htmlspecialchars($_POST['adresse']);
    $mail = htmlspecialchars($_POST['mail']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $statut = 0;
    if (is_numeric($telephone)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getBienfait = $connexion->prepare("SELECT * FROM `bienfaiteur` WHERE `telephone`=? AND mail=? AND statut=?");
        $getBienfait->execute([$telephone, $mail, $statut]);
        ($Bienfait = $getBienfait->fetch());
        if ($Bienfait > 0) {
            $msg = 'Cet bienfaiteur existe déjà dans la base de données !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/Bienfaiteur.php");
        } else {
            //Insertion data from database
            $req = $connexion->prepare("INSERT INTO `bienfaiteur`(`nom`, `postnom`, `prenom`, `genre`, `adresse`, `telephone`, `mail`, `statut`) VALUES (?,?,?,?,?,?,?,?)");
            $resultat = $req->execute([$nom, $postnom, $prenom, $genre, $adress, $telephone,$mail, $statut]);
            if ($resultat == true) {
                $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
                header("location:../../views/Bienfaiteur.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement !";
                header("location:../../views/Bienfaiteur.php");
            }
        }
    }
} else {
    header('location:../../views/Bienfaiteur.php');
}
