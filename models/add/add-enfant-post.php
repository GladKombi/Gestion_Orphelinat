<?php
include('../../connexion/connexion.php');
# Appel de la fonction qui permet de vefier la date de naissance
require_once('../../fonction/function.php');
if (isset($_POST['Valider'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $DateNaissance = htmlspecialchars($_POST['DateNaissance']);
    $photo = $_FILES['photo']['name'];
    $upload = "../../photo/" . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $upload);
    $statut = 0;
    $aujourd_hui = date("Y-m-d");
    $ado=0;
    if ($DateNaissance > $aujourd_hui) {
        $_SESSION['msg'] = "La date que vous avez selectionner ne pas valide !";
        header("location:../../views/enfant.php");
    } else {
        $age = calculerAge($DateNaissance);
        if ($age > 15) {
            $_SESSION['msg'] = "L'âge de : " . $age . " ans ne pas autoriser !";
            header("location:../../views/enfant.php");
        } else {
            //Insertion data from database
            $req = $connexion->prepare("INSERT INTO `enfant`(`nom`, `postnom`, `prenom`, `genre`, `age`, `photo`, `adopt`,  `statut`) VALUES (?,?,?,?,?,?,?,?)");
            $resultat = $req->execute([$nom, $postnom, $prenom, $genre, $DateNaissance, $photo, $ado, $statut]);
            if ($resultat == true) {
                $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
                header("location:../../views/enfant.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement !";
                header("location:../../views/enfant.php");
            }
        }
    }
} else {
    header('location:../../views/enfant.php');
}
