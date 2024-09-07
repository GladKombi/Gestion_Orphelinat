<?php
    if (isset($_GET['idClass'])){
        $id=$_GET['idClass'];
        $getDataMod=$connexion->prepare("SELECT * FROM `classe` WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();

        $url="../models/updat/up-Classe-post.php?idClass=".$id;
        $btn="Modifier";
        $title="Modifier une Classe ";
    }
    else{
        $url="../models/add/add-Classe-post.php";
        $btn="Enregistrer";
        $title="Ajouter une Classe";
    }
    /**
     * Le code qui permet d'afficher la classe, lors de l'affichage simple, et lors de la recherche
     */
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from client WHERE supprimer=0 AND client.nom LIKE ? OR client.postnom LIKE ? OR 
        client.prenom LIKE ? OR client.genre LIKE ? OR client.adresse LIKE ? OR client.telephone LIKE ?");
        $getData->execute(["%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%","%".$search."%"]);
    }
    else{
        $statut=0;
        $getData=$connexion->prepare("SELECT classe.*,`option`.`Description` FROM `classe`,`option` WHERE classe.options=`option`.id AND classe.`statut`=?");
        $getData->execute([$statut]);
    }