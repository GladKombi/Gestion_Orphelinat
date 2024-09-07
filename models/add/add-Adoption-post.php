<?php
include('../../connexion/connexion.php');
# Appel de la fonction qui permet de vefier la date de naissance
require_once('../../fonction/function.php');
if (isset($_POST['Valider'])) {
    $date = date("Y-m-d");
    $note = htmlspecialchars($_POST['note']);
    $Enfant = htmlspecialchars($_POST['enfant']);
    $tuteur = htmlspecialchars($_POST['tuteur']);
    $etat = 0;
    $statut = 0;
    if (empty($note)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/Adoption.php");
    } else {
        ## Insertion of data into the DB
        $req = $connexion->prepare("INSERT INTO `adoption`(`date`, `note`, `enfant`, `tuteur`, `Etat`, `statut`) VALUES (?,?,?,?,?,?)");
        $resultat = $req->execute([$date, $note, $Enfant, $tuteur, $etat, $statut]);
        if ($resultat == true) {
            $adopt=1;
            $UpdReq = $connexion->prepare("UPDATE `enfant` SET `adopt`=? WHERE id=?");
            $update = $UpdReq->execute([$adopt, $Enfant]);
            $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
            header("location:../../views/Adoption.php");            
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/Adoption.php");
        }
    }
} else {
    header('location:../../views/Adoption.php');
}
