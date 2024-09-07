<?php
# Chaine de connexion DB
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $mail = htmlspecialchars($_POST['mail']);
    $photo = $_FILES['photo']['name'];
    $upload = "../../photo/" . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $upload);
    $statut = 0;
    #verifier si le comptable existe ou pas dans la bd
    $statut = 0;
    $getCompta = $connexion->prepare("SELECT * FROM `comptable` WHERE `pwd`=? AND mail=? AND statut=?");
    $getCompta->execute([$nom, $mail, $statut]);
    ($Compta = $getCompta->fetch());
    if ($Compta > 0) {
        # Notification
        $msg = "L'adresse mail qui nous avez saisi à deja été attribuer !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/comptable.php");
    } else {
        #Insertion of database
        $req = $connexion->prepare("INSERT INTO `comptable`(`nom`, `postnom`, `prenom`, `pwd`, `mail`, `photo`, `statut`) VALUES (?,?,?,?,?,?,?)");
        $resultat = $req->execute([$nom, $postnom, $prenom, $pwd, $mail, $photo, $statut]);
        if ($resultat == true) {
            # Notification
            $_SESSION['msg'] = "L'Enregistrement viens d'etre effectué !";
            header("location:../../views/comptable.php");
        } else {
            # Notification
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/comptable.php");
        }
    }
} else {
    # Redirection security
    header('location:../../views/comptable.php');
}
