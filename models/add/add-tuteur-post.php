<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $confession = htmlspecialchars($_POST['confession']);
    $profession = htmlspecialchars($_POST['profession']);
    $phone = htmlspecialchars($_POST['phone']);
    $statut = 0;
    if (is_numeric($phone)) {
        //Insertion data from database
        $req = $connexion->prepare("INSERT INTO `tuteur`(`nom`, `postnom`, `prenom`, `genre`, `adresse`, `telephone`, `confession`, `profession`, `statut`) VALUES (?,?,?,?,?,?,?,?,?)");
        $resultat = $req->execute([$nom, $postnom, $prenom, $genre, $adresse, $phone, $confession, $profession, $statut]);
        if ($resultat == true) {
            $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
            header("location:../../views/tuteur.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/tuteur.php");
        }
    } else {
        $_SESSION['msg'] = "le numero de telepone ne dois pas cotainir des lettre";
        header("location:../../views/tuteur.php");
    }
}
