<?php
    if (isset($_GET['idDclara'])){
        $id=$_GET['idDclara'];
        $getDataMod=$connexion->prepare("SELECT * FROM declaration WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        # Url du traitement lors de la modification
        $url="../models/updat/up-declaration-post.php?idDclara=".$id;
        $btn="Modifier";
        $title="Modifier Declaration";
    }
    else{
        # Url du traitement lors de l'enregistrement
        $url="../models/add/add-Declaration-post.php";
        $btn="Enregistrer";
        $title="Ajouter Declaration";
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
        $getData=$connexion->prepare("SELECT declaration.`id`, declaration.`date`, declaration.`description`, enfant.nom, enfant.postnom, enfant.prenom, enfant.photo, tuteur.nom as nomtutaire, tuteur.prenom as prenomTutare FROM `declaration`,adoption,enfant,tuteur WHERE declaration.adoption=adoption.id AND adoption.enfant=enfant.id AND adoption.tuteur=tuteur.id and declaration.statut=0;");
        $getData->execute();
    }