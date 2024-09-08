<?php
# page de connexion
include('../../connexion/connexion.php');
if (isset($_POST['Valider']) && !empty($_GET['idDclara'])) {
    $id = $_GET['idDclara'];
    $note = htmlspecialchars($_POST['note']);
    if (empty($note)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/declaration.php");
    } else {
        $req = $connexion->prepare("UPDATE `declaration` SET description=? WHERE id=? ");
        $resultat = $req->execute([$note,$id]);
        if ($resultat == true) {
            # Notification
            $_SESSION['msg'] = "La modification réussi";
            header("location:../../views/declaration.php");
        } else {
            # Notification
            $_SESSION['msg'] = "Echec de la modification";
            header("location:../../views/declaration.php");
        }
    }
} else {
    # Redirection security
    header("location:../../views/declaration.php");
}
