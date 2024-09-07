<?php
if (isset($_GET['AjoutDon']) && isset($_GET['IdCategorie'])) {
    $categorie = $_GET['IdCategorie'];
    # Url du traitement lors de l'enregistrement    
    if ($categorie == 1) {
        $url = "../models/add/add-mouve-post.php?IdCategorie=1";
        $btn = "EnregistrerEntre";
        $title = "Enregistrer une entree en caisse";
    } else {
        $url = "../models/add/add-mouve-post.php?IdCategorie=2";
        $btn = "EnregistrerSortie";
        $title = "Enregistrer une sortie en caisse";
    }
}
/**
 * Le code qui permet d'afficher les client, lors de l'affichage simple, et lors de la recherche
 */
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $getData = $connexion->prepare("SELECT * from client WHERE supprimer=0 AND client.nom LIKE ? OR client.postnom LIKE ? OR 
        client.prenom LIKE ? OR client.genre LIKE ? OR client.adresse LIKE ? OR client.telephone LIKE ?");
    $getData->execute(["%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%"]);
} else {
    $statut=0;
    ## Selection of don Nature
    $getData = $connexion->prepare("SELECT * FROM `mouvementcaisse`WHERE statut=?; ");
    $getData->execute([$statut]);
}
