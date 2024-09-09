<?php
if (isset($_GET['AjoutDon']) && isset($_GET['IdCategorie'])) {
    $categorie = $_GET['IdCategorie'];
    # Url du traitement lors de l'enregistrement    
    if ($categorie == 1) {
        $url = "../models/add/add-don-post.php?IdCategorie=1";
        $btn = "EnregistrerNat";
        $title = "Enregistrer les dons en nature";
    } else {
        $url = "../models/add/add-don-post.php?IdCategorie=2";
        $btn = "EnregistrerNum";
        $title = "Enregistrer les dons en numeraire";
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
    $Nature="Nature";
    $num="Numeraire";
    ## Selection of don Nature
    $getData = $connexion->prepare("SELECT don.*, bienfaiteur.nom, bienfaiteur.postnom, bienfaiteur.prenom, bienfaiteur.telephone FROM `don`, bienfaiteur WHERE don.bienfaiteur=bienfaiteur.id and don.categorie=? and don.statut=?; ");
    $getData->execute([$Nature,$statut]);
    ## Selection of don Nature
    $getDon = $connexion->prepare("SELECT don.*, bienfaiteur.nom, bienfaiteur.postnom, bienfaiteur.prenom, bienfaiteur.telephone FROM `don`, bienfaiteur WHERE don.bienfaiteur=bienfaiteur.id and don.categorie=? and don.statut=?; "); 
    $getDon->execute([$num,$statut]);
}
if (isset($_GET['idDonNat']) && isset($_GET['IdCategorie'])){
    $id=$_GET['idDonNat'];
    $idcat=$_GET['IdCategorie'];
    $getDataMod=$connexion->prepare("SELECT * FROM don WHERE id=?");
    $getDataMod->execute([$id]);
    $tab=$getDataMod->fetch();
    # Url du traitement lors de la modification
    $url="../models/updat/up-don-post.php?idDonNat=".$id;
    $btn="Modifier";
    $title="Modifier le Don";
}
elseif (isset($_GET['idDonNum']) && isset($_GET['IdCategorie'])){
    $id=$_GET['idDonNum'];
    $idcat=$_GET['IdCategorie'];
    $getDataMod=$connexion->prepare("SELECT * FROM don WHERE id=?");
    $getDataMod->execute([$id]);
    $tab=$getDataMod->fetch();
    # Url du traitement lors de la modification
    $url="../models/updat/up-don-post.php?idDonNum=".$id;
    $btn="Modifier";
    $title="Modifier Don";

}
