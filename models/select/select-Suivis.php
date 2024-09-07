<?php
    if (isset($_GET['idSuivis'])){
        $id=$_GET['idSuivis'];
        $getDataMod=$connexion->prepare("SELECT * FROM suivis WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        # Url du traitement lors de la modification
        $url="../models/updat/up-suivis-post.php?idSuivis=".$id;
        $btn="Modifier";
        $title="Modifier un costant";
    }
    else{
        # Url du traitement lors de l'enregistrement
        $url="../models/add/add-Suivis-post.php";
        $btn="Enregistrer";
        $title="Ajouter un costant";
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
        $getData=$connexion->prepare("SELECT `suivis`.*,enfant.nom, enfant.postnom, enfant.prenom, enfant.photo, tuteur.nom as nomtutaire, tuteur.prenom as prenomTutare FROM `suivis`,enfant,adoption,tuteur WHERE suivis.adoption=adoption.id AND adoption.enfant=enfant.id and adoption.tuteur=tuteur.id and suivis.statut=0;");
        $getData->execute();
    }