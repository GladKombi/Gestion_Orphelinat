<?php
# page de connexion
include('../../connexion/connexion.php');
if (isset($_POST['Valider']) && !empty($_GET['idAdoption'])) {
    $id = $_GET['idAdoption'];
    $note = htmlspecialchars($_POST['note']);
    if (empty($note)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/Adoption.php");
    } else {
        $req = $connexion->prepare("UPDATE `adoption` SET `note`=? WHERE id=? ");
        $resultat = $req->execute([$note,$id]);
        if ($resultat == true) {
            # Notification
            $_SESSION['msg'] = "La modification réussi";
            header("location:../../views/Adoption.php");
        } else {
            # Notification
            $_SESSION['msg'] = "Echec de la modification";
            header("location:../../views/Adoption.php");
        }
    }
} else {
    # Redirection security
    header("location:../../views/Adoption.php");
}
