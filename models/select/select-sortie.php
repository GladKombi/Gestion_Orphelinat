<?php
    if (isset($_GET['idSortie'])){
        $id=$_GET['idSortie'];
        $getDataMod=$connexion->prepare("SELECT * FROM sortie WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        # Url du traitement lors de la modification
        $url="../models/updat/up-enfant-post.php?idSortie=".$id;
        $btn="Modifier";
        $title="Modifier une sortie";
    }
    else{
        # Url du traitement lors de l'enregistrement
        $url="../models/add/add-sortie-post.php";
        $btn="Enregistrer";
        $title="Faire une sortie";
    }
    /**
     * Le code qui permet d'afficher les client, lors de l'affichage simple, et lors de la recherche
     */
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from client WHERE supprimer=0 AND client.nom LIKE ? OR client.postnom LIKE ? OR 
        client.prenom LIKE ? OR client.genre LIKE ? OR client.adresse LIKE ? OR client.telephone LIKE ?");
        $getData->execute(["%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%","%".$search."%"]);
    }
    else{
        $getData=$connexion->prepare("SELECT `sortie`.*,enfant.nom, enfant.postnom, enfant.prenom, enfant.photo FROM `sortie`,enfant,adoption WHERE sortie.adoption=adoption.id AND adoption.enfant=enfant.id and sortie.statut=0;");
        $getData->execute();
    }