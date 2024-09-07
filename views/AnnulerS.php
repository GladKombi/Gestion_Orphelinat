<?php
## Se connecter à la BD
include '../connexion/connexion.php';
#modification
if (!empty($_GET['idSortie'])) {
    $id = $_GET['idSortie'];

    $sortie = 1;
    $UpdReq = $connexion->prepare("UPDATE `sortie` SET `statut`=? WHERE id=?");
    $update = $UpdReq->execute([$sortie, $id]);
    if ($update == true) {
        # Notification
        $_SESSION['msg'] = "Une sortie viens d'etre annulée";
        header("location:sortie.php");
    } else {
        # Notification
        $_SESSION['msg'] = "Echec d'annulation";
        header("location:sortie.php");
    }
} else {
    # Redirection security
    header("location:sortie.php");
}
