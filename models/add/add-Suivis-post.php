<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $date = date("Y-m-d");
    $constant = htmlspecialchars($_POST['constant']);
    $adoption = htmlspecialchars($_POST['adoption']);    
    $statut = 0;
    if (empty($constant)) {
        $msg = "Veilez completer tous les champs SVP !";
        $_SESSION['msg'] = $msg;
        header("location:../../views/suivis.php");
    } else {
        ## Insertion of data into the DB
        $req = $connexion->prepare("INSERT INTO `suivis`(`date`, `constation`, `adoption`, `statut`) VALUES (?,?,?,?)");
        $resultat = $req->execute([$date, $constant, $adoption, $statut]);
        if ($resultat == true) {
            $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
            header("location:../../views/suivis.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/suivis.php");
        }
    }
} else {
    header('location:../../views/suivis.php');
}
