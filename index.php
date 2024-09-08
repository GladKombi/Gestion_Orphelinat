<!-- <?php
include '../connexion/connexion.php';
$fonction= $_GET['fonction'];  
if(isset($_POST['connect']))
{
    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);

  if ($fonction=="user")   
  {
    $req=$connexion->prepare("SELECT * FROM `user` WHERE username=? and pwd=?");
    $req->execute(array($username,$password));
        $recup = $req->fetch();
        if($recup)
        {
            $_SESSION['id']=$recup['id'];
            header("Location: prestation.php");
        }
        else
        {
            $_SESSION["smg"]='Mot de passe incorrect ';
        }
  }
 
 if ($fonction=="membre") 
 {
   
  $req=$connexion->prepare("SELECT * FROM `beneficiaire` WHERE titulaire=? and pwd=?");
  $req->execute(array($username,$password));
      $recup = $req->fetch();
       if($recup)
       {
           $_SESSION['titulaire']=$recup['titulaire'];
           
           header("Location: affichgeben.php");
       }
       else
       {
        $_SESSION["smg"]= 'Mot de passe incorrect ';
       }
 }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
body {
    min-height: 100vh;
}
</style>
<?php require_once('styles.php')?>
<body class="d-flex justify-content-center align-items-center px-3 ">
    <div class="fixed-top container text-center pt-4">
        <span></span>
    </div>
    <form method="POST"  class="col-xl-4 col-lg-5 col-sm-7 col-md-6 card p-4">
    <div class="modal-header p-5 pb-4 border-bottom-0">
              <h4 >Connexion</h4>
              <a href="../index.php"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
            </div>
            <div class="row">
            <?php if($fonction=="user"){?>
                <div class="col-12 mb-3">
                <label for="">Adresse e-mail</label>
                <input type="email" class="form-control" placeholder="Ex: example@gmail.com" name="username">
            </div>
                <?php } else{ ?>
                    <div class="col-12 mb-3">
                <label for="">Matricule</label>
                <input type="text" class="form-control" placeholder="Matricule" name="username">
            </div>
                <?php } ?>
            <div class="col-12 mb-3">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Ex: *****" name="password">
            </div>
            <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
            <div class="col-12 ">

                <div class="alert alert-danger text-center"><?php  echo $_SESSION['msg'];?></div>
            </div>
            <?php } ?>
            <div class="col-12 mb-3">
                <input type="submit" class="form-control btn-success btn" name="connect" value="Se connecter">
            </div>
            <div class="col-12 mb-3 d-flex justify-content-between">
                <label><input type="checkbox" class="form-check-input"> Tous ensemble pour la santé </label>
            </div>
        </div>
    </form>
    <div class="fixed-bottom container text-center pb-4">
        <span>MUSOSA</span>
    </div>
</body>

</html>
 -->





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Connexion</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA -->
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="text-center">Connexion</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Nom d'utilisateur </label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Remplissez ce champ svp
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Mot de passe</label>

                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Entrer un mot de passe
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Connexion
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>