<?php
# page de connexion
include('../../connexion/connexion.php');
if (isset($_POST['Valider']) && !empty($_GET['idBienfait'])) {
    $id = $_GET['idBienfait'];
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $mail = htmlspecialchars($_POST['mail']);
    $telephone = htmlspecialchars($_POST['telephone']);
    if (is_numeric($telephone)) {
        $req = $connexion->prepare("UPDATE `bienfaiteur` SET nom=?,postnom=?,prenom=?,genre=?,adresse=?,telephone=?,mail=? WHERE id=?");
        $resultat = $req->execute([$nom,$postnom,$prenom,$genre,$adresse,$mail,$telephone,$id]);
        if ($resultat == true) {
            # Notification
            $_SESSION['msg'] = "La modification réussi";
            header("location:../../views/Bienfaiteur.php");
        } else {
            # Notification
            $_SESSION['msg'] = "Echec de la modification";
            header("location:../../views/Bienfaiteur.php");
        }
    } else {
        $msg = "Le numéro de téléphone ne doit pas etre une chaine de carractères !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/Bienfaiteur.php");
    }
} else {
    // # Redirection security
    // header("location:../../views/Bienfaiteur.php");
}
