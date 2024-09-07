<?php

if (isset($_GET['idMod']) && !empty($_GET['idMod'])) {
    $_id = $_GET['idMod'];
    #affichage simple
    $_getDataMod = $connexion->prepare("SELECT * FROM paiement WHERE id=?");
    $_getDataMod->execute([$_id]);

    if ($_tab = $_getDataMod->fetch()) {
        $_description = $_tab[2];
        $_montant = $_tab[3];
        $_commande = $_tab[4];
    }

    $_url = "../models/updat/up-paiement-post.php?id=" . $_tab[0];
    $_btn = "Modifier";
    $_desci = "Modifier la description";
    $_monta = "Modifier le montant";
    $_comma = "Modifier la commande";
    $title = "Modifier le paiement";
    //la requete qui recupere les commandes pour les ajouter dans le combobox
    $_getCommande = $connexion->prepare("SELECT client.nom,client.postnom,client.prenom,commande.id,commande.dates FROM 
    client,commande where commande.client=client.id AND client.supprimer=0 AND commande.supprimer=0");
    $_getCommande->execute();
} else {
    $_url = "../models/add/add-paiement-post.php";
    $_btn = "Ajouter";
    $_desci = "Ajouter la description";
    $_monta = "Ajouter le montant";
    $_comma = "Ajouter la commande";
    $title = "Ajouter le paiement";
    //la requete qui recupere les commandes pour les ajouter dans le combobox
    $_getCommande = $connexion->prepare("SELECT client.nom,client.postnom,client.prenom,commande.id,commande.dates FROM 
    client,commande where commande.client=client.id AND commande.statut='0' AND client.supprimer=0 AND commande.supprimer=0");
    $_getCommande->execute();
}

//la requete qui permet d'afficher les données
if (isset($_GET['search']) && !empty($_GET['search'])) {
    #La recherche...
    $_search = $_GET['search'];
    $_getData = $connexion->prepare("SELECT paiement.*,client.nom,client.postnom,client.prenom from 
        paiement,client,commande where commande.id=paiement.commande and commande.client=client.id AND paiement.supprimer=0  AND commande.supprimer=0 AND client.supprimer=0 AND 
        (paiement.dates LIKE ? OR client.nom LIKE ? OR client.postnom LIKE ? OR client.prenom LIKE ? OR paiement.montant LIKE ?)");
    $_getData->execute(["%" . $_search . "%", "%" . $_search . "%", "%" . $_search . "%", "%" . $_search . "%", "%" . $_search . "%"]);
} else {
    #Affichage simple
    $_getData = $connexion->prepare("SELECT paiement.*,client.nom,client.postnom,client.prenom from 
        paiement,client,commande where commande.id=paiement.commande and commande.client=client.id AND 
        paiement.supprimer=0  AND commande.supprimer=0 AND client.supprimer=0 ");
    $_getData->execute();
}
