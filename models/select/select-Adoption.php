<?php
    if (isset($_GET['idAdoption'])){
        $id=$_GET['idAdoption'];
        $getDataMod=$connexion->prepare("SELECT * FROM adoption WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        # Url du traitement lors de la modification
        $url="../models/updat/up-enfant-post.php?idAdoption=".$id;
        $btn="Modifier";
        $title="Modifier Adoption";
    }
    else{
        # Url du traitement lors de l'enregistrement
        $url="../models/add/add-Adoption-post.php";
        $btn="Enregistrer";
        $title="Ajouter Adoption";
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
        $getData=$connexion->prepare("SELECT adoption.*, enfant.nom, enfant.postnom, enfant.prenom, enfant.photo, tuteur.nom as nomtutaire, tuteur.prenom as prenomTutare FROM `adoption`, enfant, tuteur WHERE adoption.enfant=enfant.id and adoption.tuteur=tuteur.id and adoption.statut=0;");
        $getData->execute();
    }