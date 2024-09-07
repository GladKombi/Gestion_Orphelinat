<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Options</title>
    <?php require_once('style.php') ?>
</head>

<body>
    <div id="app">
        <?php
        require_once('Active.php');
        $ActiveUser = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4>Utilisateurs</h4>
                    </div>
                    <!-- pour afficher les massage  -->
                    <div class="alert-info alert text-center">Message</div>
                    <!-- Le form qui enregistrer les données  -->
                    <div class="col-xl-12 ">
                        <form action="" class="shadow p-3">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Nom <span class="text-danger">*</span></label>
                                    <input required type="text" class="form-control" placeholder="Entrez le nom">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Postnom <span class="text-danger">*</span></label>
                                    <input required type="text" class="form-control" placeholder="Entrez le postnom">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Fonction <span class="text-danger">*</span></label>
                                    <select required id="" name="genre" class="form-select">

                                        <option value="" desabled>Choisir une fonction</option>
                                        <option value="1">Prefet</option>
                                        <option value="2">Comptable</option>
                                        <option value="3">Proviseur</option>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Mot de pass <span class="text-danger">*</span></label>
                                    <input required type="text" class="form-control" placeholder="Entrez le mot de pass">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-4 col-sm-6 p-3">
                                    <input type="submit" class="btn btn-success w-100" value="Enregistrer">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Postnom</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <th>1</th>
                                <td>Description</td>
                                <td>Description</td>
                                <td>Description</td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm "><i class="bi bi-pencil-square"></i></a>
                                    <a href="" class="btn btn-danger btn-sm "><i class="bi bi-trash-fill"></i></a>
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; Sainte_Croix</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="wa.me:0997019883">Glad</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php require_once('script.php') ?>
</body>

</html>