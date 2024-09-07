<?php
  include('../../connexion/connexion.php');

  if (isset($_GET['idSupEnf']) && !empty($_GET['idSupEnf'])) {
    $id=$_GET['idSupEnf'];
    $supprimer=1;
    $req=$connexion->prepare("UPDATE `enfant` SET statut=? WHERE id=?");
    $resultat=$req->execute([$supprimer,$id]);
    if($resultat==true){
      $_SESSION['msg']= "La Suppression a réussi !";
      header("location:../../views/Enfant.php");
    }
    else{
        $_SESSION['msg']= "Echec de Suppression !";
        header("location:../../views/Enfant.php");
    }
  }
  else{
    header("location:../../views/Enfant.php");
  }