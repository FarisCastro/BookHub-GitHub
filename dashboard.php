<?php
    session_start();
    require_once 'config.php';
    if(!isset($_SESSION['id']) && !isset($_SESSION['nom']) && !isset($_SESSION['adresse']) && !isset($_SESSION['email']))
    {
        header('Location:index.php');
    }else{
        $bibliotheque_id = $_SESSION['id']; // ID de la bibliothèque
    }
    // Ajout de livre
    if(isset($_POST['ajouter']))
    {
        if(isset($_POST['genreLivre']) && isset($_POST['titre']) && isset($_POST['quantite']) && isset($_POST['auteur']) && isset($_POST['editeur']) && isset($_POST['description']))
        {
            $genreLivre = htmlspecialchars($_POST['genreLivre']);
            $titre = htmlspecialchars($_POST['titre'], ENT_QUOTES, 'UTF-8');
            $quantite = htmlspecialchars($_POST['quantite']);
            $auteur = htmlspecialchars($_POST['auteur'], ENT_QUOTES, 'UTF-8');
            $editeur = htmlspecialchars($_POST['editeur'], ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars($_POST['description']);
    
            // Contrôle du genre du livre
            if ($genreLivre == "Genre de livre" || empty($genreLivre)) { 
                header('Location:dashboard.php');
                exit; 
            }

            //Vérification de la quantité
            if($quantite <= 0) 
            {
                $quantite = 1;
            }
            // Vérification de l'existence du genre du livre dans la base de données
            $check_genreLivre = $bdd->prepare('SELECT * FROM genreslivre WHERE id = ?');
            $check_genreLivre->execute(array($genreLivre));
            if ($check_genreLivre->rowCount() == 0) {
                header('Location:dashboard.php');
                exit; 
            }
    
            $insert = $bdd->prepare('INSERT INTO livres(genreLivre, titre, quantite, auteur, editeur, description, bibliotheque_id) VALUES(:genreLivre, :titre, :quantite, :auteur, :editeur, :description, :bibliotheque_id)');
            $insert->execute(array(
                'genreLivre' => $genreLivre,
                'titre' => $titre,
                'quantite' => $quantite,
                'auteur' => $auteur,
                'editeur' => $editeur,
                'description' => $description,
                'bibliotheque_id' => $bibliotheque_id,
            )); 
            header('Location:dashboard.php?msg=success');
        } 
    }
    //Modifier livre
    if (isset($_POST['modifier'])) 
    {
        $livre_id = htmlspecialchars($_POST['livre_id']);
        $edit_genre = htmlspecialchars($_POST['edit_genreLivre']);
        $edit_titre = htmlspecialchars($_POST['edit_titre']);
        $edit_quantite = htmlspecialchars($_POST['edit_quantite']);
        $edit_auteur = htmlspecialchars($_POST['edit_auteur']);
        $edit_editeur = htmlspecialchars($_POST['edit_editeur']);
        $edit_description = htmlspecialchars($_POST['edit_description']);
    
        $update_sql = "UPDATE livres SET genreLivre = ?, titre = ?, quantite = ?, auteur = ?, editeur = ?, description = ? WHERE id = ? AND bibliotheque_id = ?";
        $stmt_update = $bdd->prepare($update_sql);
    
        $result = $stmt_update->execute(array($edit_genre, $edit_titre, $edit_quantite, $edit_auteur, $edit_editeur, $edit_description, $livre_id, $bibliotheque_id));
     
        if ($result) 
        {
            header("Location:dashboard.php?upd=update_success");
            exit;
        }else {
            header("Location:dashboard.php?upd=update_failure");
            exit;
        }
    }    
    // Gérer la suppression si une demande est effectuée
    if (isset($_GET['delete_id'])) 
    {
        $livre_id = htmlspecialchars($_GET['delete_id']); // Identifiant du livre à supprimer

        // Supprimer le livre si l'utilisateur est autorisé
        $sql_delete = "DELETE FROM livres WHERE id = ? AND bibliotheque_id = ?";
        $stmt_delete = $bdd->prepare($sql_delete);
        $result = $stmt_delete->execute(array($livre_id, $bibliotheque_id));

        if ($result) 
        {
            // Rediriger après suppression pour éviter des suppressions multiples lors du rechargement
            header('Location:dashboard.php?delete=success');
            exit;
        }else {
            header('Location:dashboard.php?delete=echec');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BookHub - <?php echo $_SESSION['nom']; ?></title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
              rel="stylesheet" 
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
              crossorigin="anonymous">
        <link rel="stylesheet" 
              href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="favicon.png">

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/14273d579a.js" 
                crossorigin="anonymous">
        </script>
    </head>
    <body>
        <header class="py-4">
            <nav class="navbar navbar-expand-md bg-light navbar-light fixed-top">
                <div class="container-fluid">
                    <a href="#" class="navbar-brand text-primary fw-bold">
                        <span class="bg-primary bg-gradient p-1 rounded-3 text-light">Book</span>Hub
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="bi bi-book-half text-primary"></i>
                                        <span class="fw-bold text-dark"><?php echo $_SESSION['nom']; ?></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end border-0 rounded">
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalParametre">Paramètre</a>
                                        <a href="deconnexion.php" class="dropdown-item text-danger">Se déconnecter</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <section class="py-3">
                <?php
                    // Requête pour obtenir le total des livres en tenant compte de la quantité
                    $sql_total = "SELECT IFNULL(SUM(quantite), 0) AS total FROM livres WHERE bibliotheque_id = ?";
                    $stmt_total = $bdd->prepare($sql_total);
                    $stmt_total->execute(array($bibliotheque_id));
                    $total_livres = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];

                    // Requête pour obtenir le total des romans en tenant compte de la quantité
                    $sql_roman = "SELECT IFNULL(SUM(quantite), 0) AS total FROM livres 
                    JOIN genreslivre ON livres.genreLivre = genreslivre.id 
                    WHERE genreslivre.genreLivre = 'Roman' AND livres.bibliotheque_id = ?";
                    $stmt_roman = $bdd->prepare($sql_roman);
                    $stmt_roman->execute(array($bibliotheque_id));
                    $total_roman = $stmt_roman->fetch(PDO::FETCH_ASSOC)['total'];

                    // Requête pour obtenir le total des lettres en tenant compte de la quantité
                    $sql_lettre = "SELECT IFNULL(SUM(quantite), 0) AS total FROM livres 
                    JOIN genreslivre ON livres.genreLivre = genreslivre.id 
                    WHERE genreslivre.genreLivre = 'Lettre' AND livres.bibliotheque_id = ?";
                    $stmt_lettre = $bdd->prepare($sql_lettre);
                    $stmt_lettre->execute(array($bibliotheque_id));
                    $total_lettre = $stmt_lettre->fetch(PDO::FETCH_ASSOC)['total'];

                    // Requête pour obtenir le total des bandes dessinées en tenant compte de la quantité
                    $sql_bd = "SELECT IFNULL(SUM(quantite), 0) AS total FROM livres 
                    JOIN genreslivre ON livres.genreLivre = genreslivre.id 
                    WHERE genreslivre.genreLivre = 'Bande Dessinée' AND livres.bibliotheque_id = ?";
                    $stmt_bd = $bdd->prepare($sql_bd);
                    $stmt_bd->execute(array($bibliotheque_id));
                    $total_bd = $stmt_bd->fetch(PDO::FETCH_ASSOC)['total'];
                ?>
                <div class="container-fluid">
                    <div class="row g-4">
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="bi bi-book-half fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2 fw-bold">Total de Livre</p>
                                    <h6 class="mb-0 fw-light"><?php echo htmlspecialchars($total_livres); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="bi bi-book fa-3x text-success"></i>
                                <div class="ms-3">
                                    <p class="mb-2 fw-bold">Roman</p>
                                    <h6 class="mb-0 fw-light"><?php echo htmlspecialchars($total_roman); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="bi-file-earmark-text fa-3x text-info"></i>
                                <div class="ms-3">
                                    <p class="mb-2 fw-bold">Lettre</p>
                                    <h6 class="mb-0 fw-light"><?php echo htmlspecialchars($total_lettre); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="bi-palette fa-3x text-warning"></i>
                                <div class="ms-3">
                                    <p class="mb-2 fw-bold">Bande Dessinée</p>
                                    <h6 class="mb-0 fw-light"><?php echo htmlspecialchars($total_bd); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
                // Afficher le message d'alerte si l'ajout a réussi
                if(isset($_GET['msg']))
                {
                    $msg = htmlspecialchars($_GET['msg']);
                    switch($msg)
                    {
                        case 'success':
                            ?>
                            <section class="py-3">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Succès : </strong> Livre ajouté !
                                                <div type="button" data-bs-dismiss="alert" aria-label="Close" class="btn-close"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php
                            break;
                    }
                }
                // Afficher le message d'alerte si la suppression a réussi ou echouée
                if (isset($_GET['delete'])) 
                {   
                    $msg = htmlspecialchars($_GET['delete']);
                    switch($msg)
                    {
                        case 'success':
                            ?>
                            <section class="py-3">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Opération réussi : </strong> Livre supprimé !
                                                <div type="button" data-bs-dismiss="alert" aria-label="Close" class="btn-close"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php
                            break;
                        case 'echec':
                            ?>
                            <section class="py-3">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Opération echoué : </strong> Livre n'a pas été supprimé !
                                                <div type="button" data-bs-dismiss="alert" aria-label="Close" class="btn-close"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php
                            break;
                    }
                }
                // Afficher le message d'alerte si la modification a réussi ou echouée
                if (isset($_GET['upd'])) {
                    $upd = htmlspecialchars($_GET['upd']);
                    switch ($upd) {
                        case 'update_success':
                            ?>
                            <section class="py-3">
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <div>Le livre a été modifié avec succès.</div>
                                        <div type="button" data-bs-dismiss="alert" aria-label="Close" class="btn-close"></div>
                                    </div>
                                </div>
                            </section>
                            <?php
                            break;
                
                        case 'update_failure':
                            ?>
                            <section class="py-3">
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <div>Échec de la modification du livre.</div>
                                        <div type="button" data-bs-dismiss="alert" aria-label="Close" class="btn-close"></div>
                                    </div>
                                </div>
                            </section>
                            <?php
                            break;
                    }
                }
                
            ?>
            <section class="py-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjouterLivre">Ajouter un livre</button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-3">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="fw-light fs-5 text-start">Récent livre</h4>
                        <form class="d-none d-md-flex ms-4" method="GET" action="dashboard.php"> 
                            <div class="input-group">
                                <span class="input-group-text" id="addonRechercher"><i class="bi bi-search"></i></span>
                                <input class="form-control" aria-describedby="addonRechercher" type="search" name="search" placeholder="Rechercher un livre" value="<?= htmlspecialchars($_GET['search'] ?? ''); ?>">
                            </div>
                        </form>
                    </div>
                    <table class="table table-striped table-hover align-middle text-center table-bordered">
                        <thead>
                            <tr>
                                <td>N°</td>
                                <td>Titre</td>
                                <td>Quantité</td>
                                <td>Genre</td>
                                <td>Auteur</td>
                                <td>Editeur</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $search = $_GET['search'] ?? ''; // Obtenir la valeur recherchée
                                $search_query = "%" . $search . "%"; // Pour la recherche partielle avec LIKE

                                /*$checkLivre = $bdd->prepare('SELECT livres.*, genresLivre.genreLivre AS genre FROM livres JOIN genresLivre ON livres.genreLivre = genresLivre.id WHERE livres.bibliotheque_id = ? ORDER BY livres.date_ajout DESC');
                                $checkLivre->execute(array($bibliotheque_id));
                                $livres = $checkLivre->fetchAll(PDO::FETCH_ASSOC);
                                $row = $checkLivre->rowCount();*/

                                // Requête pour récupérer les livres avec filtre de recherche
                                $checkLivre = $bdd->prepare('SELECT livres.*, genreslivre.genreLivre AS genre 
                                FROM livres 
                                JOIN genreslivre ON livres.genreLivre = genreslivre.id 
                                WHERE livres.bibliotheque_id = ? 
                                AND (livres.titre LIKE ? OR livres.auteur LIKE ? OR livres.editeur LIKE ?) 
                                ORDER BY livres.date_ajout DESC'); 
                                $checkLivre->execute(array($bibliotheque_id, $search_query, $search_query, $search_query)); // Exécution avec le filtre de recherche
                                $livres = $checkLivre->fetchAll(PDO::FETCH_ASSOC);
                                $row = $checkLivre->rowCount(); // Nombre de résultats trouvés

                                $numero = $row; // Numérotation des lignes
                                foreach ($livres as $livre) {
                            ?>
                                    <tr>
                                        <td><?= $numero; ?></td>
                                        <td><?= htmlspecialchars($livre['titre']); ?></td>
                                        <td><?= htmlspecialchars($livre['quantite']); ?></td>
                                        <td><?= htmlspecialchars($livre['genre']); ?></td>
                                        <td><?= htmlspecialchars($livre['auteur']); ?></td>
                                        <td><?= htmlspecialchars($livre['editeur']); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success mx-1" data-bs-toggle="modal" data-bs-target="#modalDetailLivre<?= htmlspecialchars($livre['id']); ?>"><i class="bi bi-eye"></i></button>
                                            <a class="btn btn-sm btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#modalModifierLivre<?= htmlspecialchars($livre['id']); ?>"><i class="bi bi-pencil-square"></i></a>
                                            <a href="dashboard.php?delete_id=<?= htmlspecialchars($livre['id']); ?>" class="btn btn-sm btn-danger mx-1"><i class="bi bi-trash"></i></a>
                                        </td>
                                    <?php $numero--; // Décrémenter le numéro ?>

                                    <!-- Modal avec les détails du livre -->
                                    <div class="modal fade" id="modalDetailLivre<?= htmlspecialchars($livre['id']); ?>" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Informations du Livre</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p class="fw-bold text-end">Titre :</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-light"><?= htmlspecialchars($livre['titre']); ?></p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-bold text-end">Quantité :</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-light"><?= htmlspecialchars($livre['quantite']); ?></p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-bold text-end">Genre :</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-light"><?= htmlspecialchars($livre['genre']); ?></p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-bold text-end">Auteur :</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-light"><?= htmlspecialchars($livre['auteur']); ?></p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-bold text-end">Editeur :</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-light"><?= htmlspecialchars($livre['editeur']); ?></p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-bold text-end">Description :</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="fw-light">
                                                                <?php
                                                                    if(empty(htmlspecialchars($livre['description']))) echo "Aucune";
                                                                    else echo htmlspecialchars($livre['description']); 
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Modifier Livre -->
                                    <div class="modal fade" id="modalModifierLivre<?= htmlspecialchars($livre['id']); ?>" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Modifier le livre</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST" class="row g-3">
                                                        <input type="hidden" name="livre_id" value="<?= htmlspecialchars($livre['id']); ?>">
                                                        <div class="col-12">
                                                            <select name="edit_genreLivre" class="form-select" required>
                                                                <?php
                                                                    $sql = "SELECT * FROM genreslivre";
                                                                    $stmt = $bdd->prepare($sql);
                                                                    $stmt->execute();
                                                                    $genresLivre = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                    echo '<option>Genre de livre</option>';
                                                                    foreach ($genresLivre as $genreLivre) 
                                                                    {
                                                                        $selected = (htmlspecialchars($genreLivre['genreLivre']) == htmlspecialchars($livre['genre'])) ? 'selected' : '';
                                                                        echo '<option value="' . htmlspecialchars($genreLivre['id']) . '" ' . $selected . '>' . htmlspecialchars($genreLivre['genreLivre']) . '</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-text" id="addonTitre">Titre</span>
                                                                <input type="text" name="edit_titre" class="form-control" aria-describedby="addonTitre" required value="<?= htmlspecialchars($livre['titre']); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-text" id="addonQuantite">Quantité</span>
                                                                <input type="number" name="edit_quantite" class="form-control" aria-describedby="addonQuantite" value="<?= htmlspecialchars($livre['quantite']); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-text" id="addonAuteur">Auteur</span>
                                                                <input type="text" name="edit_auteur" class="form-control" aria-describedby="addonAuteur"  value="<?= htmlspecialchars($livre['auteur']); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-text" id="addonEditeur">Editeur</span>
                                                                <input type="text" name="edit_editeur" class="form-control" aria-describedby="addonEditeur"  value="<?= htmlspecialchars($livre['editeur']); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="description" class="form-label">Description du livre</label>
                                                            <textarea class="form-control" name="edit_description" id="description" rows="3">
                                                                <?= htmlspecialchars($livre['description']); ?>
                                                            </textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="submit" name="modifier" class="btn btn-warning w-100 text-uppercase">Modifier</button>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="dashboard.php" class="btn btn-danger w-100 text-uppercase">Annuler</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>


        <!-- Modal Ajouter Livre -->
        <div class="modal fade" id="modalAjouterLivre" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Ajouter un nouveau livre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="row gy-3">
                            <div class="col-12">
                                <select name="genreLivre" class="form-select" required>
                                    <?php
                                        $sql = "SELECT * FROM genreslivre";
                                        $stmt = $bdd->prepare($sql);
                                        $stmt->execute();
                                        $genresLivre = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        echo '<option selected>Genre de livre</option>';
                                        foreach ($genresLivre as $genreLivre) 
                                        {
                                            echo '<option value="' . htmlspecialchars($genreLivre['id']) . '">' . htmlspecialchars($genreLivre['genreLivre']) . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="addonTitre">Titre</span>
                                    <input type="text" name="titre" class="form-control" aria-describedby="addonTitre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="addonQuantite">Quantité</span>
                                    <input type="number" name="quantite" class="form-control" aria-describedby="addonQuantite">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="addonAuteur">Auteur</span>
                                    <input type="text" name="auteur" class="form-control" aria-describedby="addonAuteur" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="addonEditeur">Editeur</span>
                                    <input type="text" name="editeur" class="form-control" aria-describedby="addonEditeur" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description du livre</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                            <div class="col-6">
                                <button type="submit" name="ajouter" class="btn btn-success w-100 text-uppercase">Ajouter</button>
                            </div>
                            <div class="col-6">
                                <a href="dashboard.php" class="btn btn-danger w-100 text-uppercase">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Paramètre -->
        <div class="modal fade" id="modalParametre" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Paramètre de votre compte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="fw-bold text-end">Nom :</p>
                            </div>
                            <div class="col-6">
                                <p class="fw-light"><?php echo $_SESSION['nom']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="fw-bold text-end">Adresse :</p>
                            </div>
                            <div class="col-6">
                                <p class="fw-light"><?php echo $_SESSION['adresse']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="fw-bold text-end">Email :</p>
                            </div>
                            <div class="col-6">
                                <p class="fw-light"><?php echo $_SESSION['email']; ?></p>
                            </div>
                            <div class="col-12">
                                <p class="fw-light">Vous allez être en mesure de modifier vos informations d'ici peux. Merci !</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS bundle -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
                crossorigin="anonymous">
        </script>
    </body>
</html>