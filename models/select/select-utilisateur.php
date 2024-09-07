<?php
    if (isset($_GET['iduser'])){
        $id=$_GET['iduser'];
        $getDataMod=$connexion->prepare("SELECT * FROM utilisateur WHERE id=?");
        $getDataMod->execute([$id]);
        if($tab=$getDataMod->fetch()){
            $nom=$tab[1];
            $postnom=$tab[2];
            $prenom=$tab[3];
            $genre=$tab[4];
            $adresse=$tab[5];
            $telephone=$tab[6];
            $email=$tab[7];
            $password=$tab[8];
            $boutique=$tab[9];
            $fonction=$tab[10];
        }
        /**
         * Ici je specifie le lien lors qu'il s'agit de la modification, ce lien montre ou il faut allez faire la modification 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/updat/up-utilisateur-post.php?iduser=".$id;
        $btn="Modifier";
        $title="Modifier Utilisateur";
    }
    else{
        /**
         * Ici je specifie le lien lors qu'il s'agit de l'enregistrement, ce lien montre ou il faut allez faire l'enregistrement 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/add/add-utilisateur-post.php";
        $btn="Enregistrer";
        $title="Ajouter Utilisateur";
    }

    /**
     * Recuperer les boutiques pour les clés étrangères
     */
    $getBoutique=$connexion->prepare("SELECT * from boutique where supprimer!=1");
    $getBoutique->execute();

    /**
     * Le code qui permet d'afficher les boutiques, lors de l'affichage simple, et lors de la recherche
     */
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT utilisateur. `id`,utilisateur.`nom`, utilisateur.`postnom`, utilisateur.`prenom`, 
        utilisateur.`genre`, utilisateur.`adresse`, utilisateur.`telephone`, utilisateur.`email`,utilisateur.`pwd`, 
        boutique.nom as boutique ,boutique.description, utilisateur.fonction FROM `utilisateur`,boutique WHERE utilisateur.boutique=boutique.id AND 
        utilisateur.supprimer=0 AND boutique.supprimer=0 AND (utilisateur.`nom` LIKE ? OR utilisateur.`postnom` LIKE ? OR 
        utilisateur.`prenom` LIKE ? OR utilisateur.`genre` LIKE ? OR utilisateur.`adresse` LIKE ? OR utilisateur.`telephone`LIKE ? OR
        utilisateur.`email` LIKE ? OR utilisateur.`pwd` LIKE ? OR utilisateur.fonction LIKE ? OR   boutique.nom LIKE ? OR boutique.description LIKE ?)");
        $getData->execute(["%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", 
        "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%"]);
    }
    else{
        $getData=$connexion->prepare("SELECT utilisateur. `id`,utilisateur. `nom`, utilisateur.`postnom`, utilisateur.`prenom`, 
        utilisateur.`genre`, utilisateur.`adresse`, utilisateur.`telephone`, utilisateur.`email`,utilisateur.`pwd`, 
        boutique.nom as boutique,boutique.description, utilisateur.fonction FROM `utilisateur`,boutique WHERE utilisateur.boutique=boutique.id AND 
        utilisateur.supprimer=0 AND boutique.supprimer=0 ");
        $getData->execute();
    }