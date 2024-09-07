<?php
    if (isset($_GET['idcat']))
    {
        $id=$_GET['idcat'];        
        $getDataMod=$connexion->prepare("SELECT * FROM typeproduit WHERE id= ?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();        
        
        $url="../models/updat/up-categorie-post.php?idcat=".$id;//Cette varible permet de savoir sur quelle page l'action va etre executée lors de la modification
        $btn="Modifier";//On chager le texte sur le button qui sert à modifier ou ajouter
        $title="Modifier catégorie";
    }
    else{
        $url="../models/add/ajoutcat.php";//Cette varible permet de savoir sur quelle page l'action va etre executée lors de l'enregistrement. il sera mit dans l'attribut action dans le form
        $btn="Enregistrer";//On chager le texte sur le button qui sert à modifier ou ajouter
        $title="Ajouter catégorie";
    }

    #La requette qui permet de faire les affichages et recherche
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from typeproduit WHERE staut=? AND description LIKE ?");
        $getData->execute([0, "%".$search."%"]);
    }
    else{
        $getData=$connexion->prepare("SELECT * from typeproduit WHERE statut=?");
        $getData->execute([0]);
    }