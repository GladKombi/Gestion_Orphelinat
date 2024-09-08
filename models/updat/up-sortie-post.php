<?php
# page de connexion
include('../../connexion/connexion.php');

if (isset($_POST['Valider']) && !empty($_GET['idupsortie'])) {
    $id = $_GET['idupsortie'];
    $description = htmlspecialchars($_POST['description']);
    if (empty($description)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/sortie.php");
    } else {
        $req = $connexion->prepare("UPDATE `sortie` SET `description`=? WHERE id=?;");
        $resultat = $req->execute([$description, $id]);
        if ($resultat == true) {
            # Notification
            $_SESSION['msg'] = "La modification réussi";
            header("location:../../views/sortie.php");
        } else {
            # Notification
            $_SESSION['msg'] = "Echec de la modification";
            header("location:../../views/sortie.php");
        }
    }
} else {
    # Redirection security
    header("location:../../views/sortie.php");
}
