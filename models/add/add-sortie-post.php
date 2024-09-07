<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $date = date("Y-m-d");
    $description = htmlspecialchars($_POST['description']);
    $adoption = htmlspecialchars($_POST['adoption']);    
    $statut = 0;
    if (empty($description)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/sortie.php");
    } else {
        ## Insertion of data into the DB
        $req = $connexion->prepare("INSERT INTO `sortie`(`date`, `description`, `adoption`, `statut`) VALUES (?,?,?,?)");
        $resultat = $req->execute([$date, $description, $adoption, $statut]);
        if ($resultat == true) {
            $adopt=1;
            $UpdReq = $connexion->prepare("UPDATE `adoption` SET `statut`=? WHERE id=?");
            $update = $UpdReq->execute([$adopt, $adoption]);
            $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
            header("location:../../views/sortie.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/sortie.php");
        }
    }
} else {
    header('location:../../views/sortie.php');
}