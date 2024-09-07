<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $date = date("Y-m-d");
    $note = htmlspecialchars($_POST['note']);
    $adoption = htmlspecialchars($_POST['adoption']);    
    $statut = 0;
    if (empty($note)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/declaration.php");
    } else {
        ## Insertion of data into the DB
        $req = $connexion->prepare("INSERT INTO `declaration`(`date`, `description`, `adoption`, `statut`) VALUES (?,?,?,?)");
        $resultat = $req->execute([$date, $note, $adoption, $statut]);
        if ($resultat == true) {
            $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
            header("location:../../views/declaration.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/declaration.php");
        }
    }
} else {
    header('location:../../views/declaration.php');
}
