<?php
# page de connexion
include('../../connexion/connexion.php');
#fonction de calcul Age
require_once('../../fonction/function.php');
#modification
if (isset($_POST['Valider']) && !empty($_GET['idEnfant'])) {
    $id = $_GET['idEnfant'];
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $DateNaissance = htmlspecialchars($_POST['DateNaissance']);
    $photo = $_FILES['photo']['name'];
    $upload = "../../photo/" . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $upload);
    $statut = 0;
    # Age verification
    $aujourd_hui = date("Y-m-d");
    if ($DateNaissance > $aujourd_hui) {
        # Notification
        $_SESSION['msg'] = "La date que vous avez selectionner ne pas valide !";
        header("location:../../views/enfant.php");
    } else {
        $age = calculerAge($DateNaissance);
        if ($age > 15) {
            # Notification
            $_SESSION['msg'] = "L'âge de : " . $age . " ans ne pas autoriser !";
            header("location:../../views/enfant.php");
        } else {
            $req = $connexion->prepare("UPDATE `enfant` SET `nom`=?,`postnom`=?,`prenom`=?,`genre`=?,`age`=?,`photo`=? WHERE id=?");
            $resultat = $req->execute([$nom, $postnom, $prenom, $genre, $DateNaissance, $photo, $id]);
            if ($resultat == true) {
                # Notification
                $_SESSION['msg'] = "La modification réussi";
                header("location:../../views/enfant.php");
            } else {
                # Notification
                $_SESSION['msg'] = "Echec de la modification";
                header("location:../../views/enfant.php");
            }
        }
    }
} else {
     # Redirection security
    header("location:../../views/enfant.php");
}
