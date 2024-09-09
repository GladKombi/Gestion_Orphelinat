<?php
# page de connexion
include('../../connexion/connexion.php');

if (isset($_POST['Modifier']) && !empty($_GET['idDonNat'])) {
    $id = $_GET['idDonNat'];
    $bienfaiteur = htmlspecialchars($_POST['bienfaiteur']);
    $description = htmlspecialchars($_POST['description']);
    if (empty($description)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/don.php");
    } else {
        $req = $connexion->prepare("UPDATE `don` SET `description`=?,bienfaiteur=? WHERE id=?;");
        $resultat = $req->execute([$description,$bienfaiteur,$id]);
        if ($resultat == true) {
            # Notification
            $_SESSION['msg'] = "La modification réussi";
            header("location:../../views/don.php");
        } else {
            # Notification
            $_SESSION['msg'] = "Echec de la modification";
            header("location:../../views/don.php");
        }
    }
} else {
    # Redirection security
    header("location:../../views/don.php");
}

if (isset($_POST['Modifier']) && !empty($_GET['idDonNum'])) {
    $id = $_GET['idDonNum'];
    $description = htmlspecialchars($_POST['description']);
    $bienfaiteur = htmlspecialchars($_POST['bienfaiteur']);
    $montant=htmlspecialchars($_POST['montant']);
    if (empty($description) && empty($bienfaiteur) && empty($montant)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/don.php");
    } else {
        $req = $connexion->prepare("UPDATE `don` SET `description`=?,bienfaiteur=?,montant=? WHERE id=?;");
        $resultat = $req->execute([$description,$bienfaiteur,$montant,$id]);
        if ($resultat == true) {
            # Notification
            $_SESSION['msg'] = "La modification réussi";
            header("location:../../views/don.php");
        } else {
            # Notification
            $_SESSION['msg'] = "Echec de la modification";
            header("location:../../views/don.php");
        }
    }
} else {
    # Redirection security
    header("location:../../views/don.php");
}
