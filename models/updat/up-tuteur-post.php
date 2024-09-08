<?php
# page de connexion
include('../../connexion/connexion.php');
if (isset($_POST['Valider']) && !empty($_GET['idTuteur'])) {
    $id = $_GET['idTuteur'];
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $confession = htmlspecialchars($_POST['confession']);
    $profession = htmlspecialchars($_POST['profession']);
    $phone = htmlspecialchars($_POST['telephone']);
    if (is_numeric($phone)) {
        $req = $connexion->prepare("UPDATE `tuteur` SET nom=?,postnom=?,prenom=?,genre=?,adresse=?,confession=?,profession=?,telephone=? WHERE id=?");
        $resultat = $req->execute([$nom,$postnom,$prenom,$genre,$adresse,$confession,$profession,$phone,$id]);
        if ($resultat == true) {
            # Notification
            $_SESSION['msg'] = "La modification réussi";
            header("location:../../views/tuteur.php");
        } else {
            # Notification
            $_SESSION['msg'] = "Echec de la modification";
            header("location:../../views/tuteur.php");
        }
    } else {
        $msg = "Le numéro de téléphone ne doit pas etre une chaine de carractères !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/tuteur.php");
    }
} else {
    // # Redirection security
     header("location:../../views/tuteur.php");
}
