<?php
    if (isset($_GET['idEnfant'])){
        $id=$_GET['idEnfant'];
        $getDataMod=$connexion->prepare("SELECT * FROM enfant WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        # Url du traitement lors de la modification
        $url="../models/updat/up-enfant-post.php?idEnfant=".$id;
        $btn="Modifier";
        $title="Modifier un(e) enfant";
    }
    else{
        # Url du traitement lors de l'enregistrement
        $url="../models/add/add-enfant-post.php";
        $btn="Enregistrer";
        $title="Ajouter un(e) enfant";
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
        $getData=$connexion->prepare("SELECT * from enfant WHERE statut=0");
        $getData->execute();
    }
