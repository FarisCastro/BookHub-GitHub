<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BookHub - Enregistrement</title>

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
        <?php
            if(isset($_GET['reg_err']))
            {
                $err = htmlspecialchars($_GET['reg_err']);
                switch($err)
                {
                    case 'invalid_genre':
                        ?>
                        <div class="alert alert-danger w-75 mx-auto">
                            <strong>Erreur : </strong> Veuillez sélectionner le genre de votre bibliothèque !
                        </div>
                        <?php
                        break;   
                    case 'already':
                        ?>
                        <div class="alert alert-danger w-75 mx-auto">
                            <strong>Erreur : </strong> Compte déjà existant !
                        </div>
                        <?php
                        break;
                    case 'nom_invalide':
                        ?>
                        <div class="alert alert-danger w-75 mx-auto">
                            <strong>Erreur : </strong> Nom invalide !
                        </div>
                        <?php
                        break;
                    case 'nom_length':
                        ?>
                        <div class="alert alert-danger w-75 mx-auto">
                            <strong>Erreur : </strong> Nom trop long !
                        </div>
                        <?php
                        break;
                    case 'email_length':
                        ?>
                        <div class="alert alert-danger w-75 mx-auto">
                            <strong>Erreur : </strong> Email trop long !
                        </div>
                        <?php
                        break;
                    case 'adr_length':
                        ?>
                        <div class="alert alert-danger w-75 mx-auto">
                            <strong>Erreur : </strong> Adresse trop long !
                        </div>
                        <?php
                        break;
                    case 'email':
                        ?>
                        <div class="alert alert-danger w-75 mx-auto">
                            <strong>Erreur : </strong> Email invalide !
                        </div>
                        <?php
                        break;
                    case 'password':
                        ?>
                        <div class="alert alert-danger w-75 mx-auto">
                            <strong>Erreur : </strong> Mots de passe différent !
                        </div>
                        <?php
                        break;
                    case 'success':
                        ?>
                        <div class="alert alert-success w-75 mx-auto">
                            <strong>Succès : </strong> Enregistrement réussie, connectez-vous pour continuer !
                        </div>
                        <?php
                        break;
                }
            }
        ?>
        <div class="container w-75 my-5 border rounded p-5 bg-light">
            <div class="row g-0">
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-8 px-5">
                    <a href="index.html" class="navbar-brand text-primary fw-bold">
                        <span class="bg-primary bg-gradient p-1 rounded-3 text-light">Book</span>Hub
                    </a>
                    <h5 class="fw-light mt-2">Enregistrez votre bibliothèque</h2>
                    <form action="enregistrement_traitement.php" method="POST" class="row gy-3 my-3">
                        <div class="col-12">
                            <label for="bibliotheque" class="form-label">Informations de la bibliothèque</label>
                            <select name="genre" class="form-select" id="bibliotheque" required>
                                <?php
                                    require_once 'config.php'; 
                                    $sql = "SELECT * FROM genres";
                                    $stmt = $bdd->prepare($sql);
                                    $stmt->execute();
                                    $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    echo '<option selected>Genre de bibliothèque</option>';
                                    foreach ($genres as $genre) 
                                    {
                                        echo '<option value="' . htmlspecialchars($genre['id']) . '">' . htmlspecialchars($genre['genre']) . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text" id="addonNom">Nom</span>
                                <input type="text" name="nom" class="form-control" id="nom_bibliotheque" aria-describedby="addonNom" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text" id="addonAdresse">Adresse</span>
                                <input type="text" name="adresse" class="form-control" aria-describedby="addonAdresse" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Identifiants de connexion</label>
                            <div class="input-group">
                                <span class="input-group-text" id="addonEmail">E-mail</span>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="addonEmail" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text" id="addonPassword">Password</span>
                                <input type="password" name="password" class="form-control" aria-describedby="addonPassword" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <span class="input-group-text" id="addonPasswordConfirmer">Password</span>
                                <input type="password" name="passwordConfirmer" placeholder="Confirmer password" class="form-control" aria-describedby="addonPasswordConfirmer" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="connexion" class="btn btn-primary w-100 text-uppercase">S'enregistrer</button>
                        </div>
                    </form>
                    <a href="connexion.php" class="fw-light fs-5 text-primary text-decoration-none">Êtes-vous membre de BookHub ? Se connecter</a>
                    <br>
                    <a href="#" class="text-decoration-none text-dark fw-light" data-bs-toggle="modal" data-bs-target="#modalMentionsLegales">
                        Mentions légales
                    </a>
                    <div class="modal fade" id="modalMentionsLegales" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Mentions Légales</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-start"><span class="fw-bold">1. Informations générales</span><br>Ce site web est exploité par <span class="fw-bold">Faris Castro CHABI ABOUDOU</span>, et son utilisation est soumise aux conditions énoncées dans ces mentions légales.</p>
                                    <p class="text-start"><span class="fw-bold">2. Propriété intellectuelle</span><br>Tous les contenus présents sur ce site, y compris mais sans s'y limiter, les textes, images, logos, icônes, clips audio et vidéo, sont la propriété exclusive de <span class="fw-bold">Faris Castro CHABI ABOUDOU</span> ou de ses fournisseurs de contenu et sont protégés par les lois nationales et internationales sur le droit d'auteur.</p>
                                    <p class="text-start"><span class="fw-bold">3. Utilisation de l'application</span><br>L'utilisation de notre application web est entièrement gratuite pour tous les utilisateurs. Nous nous réservons cependant le droit de modifier, suspendre ou interrompre temporairement ou définitivement tout ou partie de notre service sans préavis.</p>
                                    <p class="text-start"><span class="fw-bold">4. Collecte de données personnelles</span><br>Nous collectons et traitons les données personnelles conformément à notre politique de confidentialité. Nous nous engageons à protéger la confidentialité et la sécurité des informations fournies par nos utilisateurs.</p>
                                    <p class="text-start"><span class="fw-bold">5. Responsabilité</span><br>Nous nous efforçons de garantir l'exactitude et la mise à jour des informations disponibles sur ce site, mais nous ne pouvons garantir que toutes les informations sont exemptes d'erreurs ou d'omissions. En utilisant ce site, vous acceptez de le faire à vos propres risques et sous votre seule responsabilité.</p>
                                    <p class="text-start"><span class="fw-bold">6. Liens externes</span><br>Ce site peut contenir des liens vers des sites web tiers. Ces liens sont fournis à titre informatif seulement et n'impliquent pas notre approbation des contenus de ces sites. Nous déclinons toute responsabilité quant au contenu ou à l'exactitude des informations présentes sur ces sites tiers.</p>
                                    <p class="text-start"><span class="fw-bold">7. Contact</span><br>Pour toute question ou préoccupation concernant ces mentions légales, veuillez nous contacter à l'adresse suivante : <br><br>
                                        <span class="fw-bold">Nom complet : </span>Faris Castro CHABI ABOUDOU <br>
                                        <span class="fw-bold">Ville : </span>Parakou <br>
                                        <span class="fw-bold">Pays : </span>République du Bénin <br>
                                        <span class="fw-bold">Téléphone : </span>0022991093539 <br>
                                        <span class="fw-bold">E-mail : </span>fariscastrochabi@gmail.com
                                    </p>
                                </div>
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