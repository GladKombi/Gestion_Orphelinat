<?php
  include('../../connexion/connexion.php');
  if(isset($_POST['Valider'])){
    $description=htmlspecialchars($_POST['description']);
    if(!empty($description)){
      #verifier si la periode existe ou pas dans la bd
      $statut=0;
      $getPeriode=$connexion->prepare("SELECT * FROM `periode` WHERE `libelle`=? AND statut=?");
      $getPeriode->execute([$description,$statut]);
      ($periode=$getPeriode->fetch());
      if($periode>0){
        $msg='Cette periode existe déjà dans la base de données !';  
        $_SESSION['msg']=$msg;
        header("location:../../views/Periode.php");
      }else{ 
        //Insertion data from database
        $req=$connexion->prepare("INSERT INTO `periode`(`libelle`, `statut`) VALUES(?,?)");
        $resultat=$req->execute([$description,$statut]);
        if($resultat==true){
          $_SESSION['msg']="Un Enregistrement viens d'etre effectué !";
          header("location:../../views/Periode.php");
        }
        else{
          $_SESSION['msg']="Echec d'enregistrement !";
          header("location:../../views/Periode.php");
        }
      }
    }
    else{
      $_SESSION['msg']="Completer tous les champs SVP !";
      header("location:../../views/Periode.php");
    }
  }
  else{
    header('location:../../views/Periode.php');
  }
