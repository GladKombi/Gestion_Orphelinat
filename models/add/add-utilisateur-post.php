<?php
  include('../../connexion/connexion.php');

  if(isset($_POST['valider'])){
      $nom=htmlspecialchars($_POST['nom']);
      $postnom=htmlspecialchars($_POST['postnom']);
      $prenom=htmlspecialchars($_POST['prenom']);
      $genre=htmlspecialchars($_POST['genre']);
      $adresse=htmlspecialchars($_POST['adresse']);
      $telephone=htmlspecialchars($_POST['telephone']);
      $email=htmlspecialchars($_POST['email']);
      $pwd=htmlspecialchars($_POST['pwd']);
      $boutique=htmlspecialchars($_POST['boutique']);
      $fonction=htmlspecialchars($_POST['fonction']);


      #verifier si l'utilisateur existe ou pas dans la bd
      $getBoutiqueUtilisateurs=$connexion->prepare("SELECT * FROM `utilisateur` WHERE telephone=? AND supprimer=?");
      $getBoutiqueUtilisateurs->execute([$telephone, 0]);
      $tab=$getBoutiqueUtilisateurs->fetch();
        if($tab>0){
        $_SESSION['msg']='cet Utlisateur existe dejà dans la base de données';//Cette variable recoit le message pour notifier l'utilisateur de l'opération qu'il deja fait
        header("location:../../views/utilsateur.php");  
      }else{ 
        //Insertion data from database
        $req=$connexion->prepare("INSERT INTO utilisateur ( nom, postnom, prenom, genre, adresse, telephone, email, pwd, boutique, fonction) values (?,?,?,?,?,?,?,?,?,?)");
        $resultat=$req->execute([$nom,$postnom,$prenom,$genre,$adresse,$telephone,$email,$pwd,$boutique,$fonction]);
        if($resultat==true){
          $_SESSION['msg']="Enregistrement réussie";
          header("location:../../views/utilisateur.php");
        }
        else{
          $_SESSION['msg']="Echec d'enregistrement";
          header("location:../../views/utilisateur.php");
        }
      }
  }else{
    header("location:../../views/utilisateur.php");
  }
?>