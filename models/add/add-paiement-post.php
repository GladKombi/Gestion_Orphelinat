<?php
//la connexion a la base de données
include_once('../../connexion/connexion.php');

//la creation de l'evenement qui sert à envoyer les données à la base de données
//Lors qu'on a cliquer sur le bouton valider

if (isset($_POST['send'])) {
    $_description = htmlspecialchars($_POST['description']);
    $_montant = htmlspecialchars($_POST['montant']);
    $_commande = htmlspecialchars($_POST['commande']);

    //la requete qui envoi les données de la base de données
    $req = $connexion->prepare("SELECT panier.quantite*panier.prix as montant from panier,commande where commande.id=panier.commande  and commande.id='$_commande'");
    $req->execute();
    $montrecup = 0;

    while ($mon = $req->fetch()) {
        $montrecup = $montrecup + $mon['montant'];
    }

    if ($montrecup < $_montant) {
        $_SESSION['msg'] = "le montant est superieur ";
        header("Location:../../views/paiement.php");
    } else if ($montrecup > $_montant) {
        $supprimer = 0;

        $_sendData = $connexion->prepare("INSERT INTO paiement VALUES (NULL,NOW(),?,?,?,?)");
        $_rows = $_sendData->execute([$_description, $_montant, $_commande, $supprimer]);

        if ($_rows == 1) {
            $montant = $montrecup - $_montant;
            $description = "reste";

            $_sendData = $connexion->prepare("INSERT INTO dettes VALUES (NULL,NOW(),?,?,?,?)");
            $_rowss = $_sendData->execute([$description, $montant, $_commande, $supprimer]);

            if ($_rowss == 1) {
                $statut = 1;
                $req = $connexion->prepare("UPDATE commande set statut=? where id='$_commande'");
                $req->execute(array($statut));

                $_SESSION['msg'] = "Enregistrement reussie";
                header("Location:../../views/paiement.php");
            }
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement";
            header("Location:../../views/paiement.php");
        }
    } else {
        $supprimer=0;
        $_sendData = $connexion->prepare("INSERT INTO paiement VALUES (NULL,NOW(),?,?,?,?)");
        $_rows = $_sendData->execute([$_description, $_montant, $_commande, $supprimer]);

        if ($_rows == 1) {

            $statut = 1;
            $req = $connexion->prepare("UPDATE commande set statut=? where id='$_commande'");
            $req->execute(array($statut));

            $_SESSION['msg'] = "Enregistrement reussie";
            header("Location:../../views/paiement.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement";
            header("Location:../../views/paiement.php");
        }
    }


    //    $_sendData=$connexion->prepare("INSERT INTO paiement VALUES (NULL,NOW(),?,?,?)");
    //    $_rows=$_sendData->execute([$_description,$_montant,$_commande]);
    //    if($_rows==1){
    //     $_SESSION['msg']="Enregistrement reussie";
    //         header("Location:../../views/paiement.php");
    //    }
    //    else{
    //     $_SESSION['msg']="Echec d'enregistrement";
    //         header("Location:../../views/paiement.php");
    //    }

} else {
    header("Location:../../views/paiement.php");
}
