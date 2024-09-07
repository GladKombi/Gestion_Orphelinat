<?php
# page de connexion
include('../../connexion/connexion.php');
#fonction de calcul Age
require_once('../../fonction/function.php');
#modification
if (isset($_POST['Valider']) && !empty($_GET['idSuivis'])) {
    $id = $_GET['idSuivis'];
    $constant = htmlspecialchars($_POST['constant']);
    $adoption = htmlspecialchars($_POST['adoption']);
    $statut = 0;
    if (empty($constant)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/suivis.php");
    } else {
        $req = $connexion->prepare("UPDATE `suivis` SET `constation`=?,`adoption`=? WHERE id=?;");
        $resultat = $req->execute([$constant, $adoption, $id]);
        if ($resultat == true) {
            # Notification
            $_SESSION['msg'] = "La modification réussi";
            header("location:../../views/suivis.php");
        } else {
            # Notification
            $_SESSION['msg'] = "Echec de la modification";
            header("location:../../views/suivis.php");
        }
    }
} else {
    # Redirection security
    header("location:../../views/suivis.php");
}
