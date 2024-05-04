<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BookHub - Accueil</title>

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
                <div class="container">
                    <a href="index.php" class="navbar-brand text-primary fw-bold">
                        <span class="bg-primary bg-gradient p-1 rounded-3 text-light">Book</span>Hub
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#apropos" class="nav-link text-uppercase">A propos</a>
                            </li>
                            <li class="nav-item">
                                <a href="#caracteristiques" class="nav-link text-uppercase">Caractéristiques</a>
                            </li>
                            <li class="nav-item">
                                <a href="#faq" class="nav-link text-uppercase">FAQ</a>
                            </li>
                            <li class=3"nav-item">
                                <a href="connexion.php" class="nav-link text-uppercase">Se connecter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <section class="py-5">
                <div class="container">
                    <div class="row align-items-center gy-4 gy-md-0">
                        <div class="col-12 col-md-8">
                            <h1 class="fw-bold fst-italic">Gérez votre bibliothèque avec facilité</h1>
                            <h2 class="fw-light">Ajoutez, modifiez et supprimez des livres en toute simplicité grâce à notre plateforme conviviale.</h2>
                            <a href="enregistrement.php" class="btn btn-primary mt-5">Essayer Maintenant</a>
                        </div>
                        <div class="col-12 col-md-4">
                            <img src="img/IMG_2.png" alt="Bibliothèque" class="w-100">
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-5 bg-light" id="apropos">
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle fa-2x me-3 text-primary"></i>
                                <h3 class="text-primary fw-light text-uppercase m-0">Simple d'utilisation</h3>
                            </div>
                            <p class="fw-lighter fs-10">Notre plateforme est conçue pour être intuitive et conviviale, même pour les utilisateurs novices. Vous pouvez facilement naviguer, ajouter et gérer vos livres sans tracas.</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-journal-check fa-2x me-3 text-primary"></i>
                                <h3 class="text-primary fw-light text-uppercase m-0">Puissant outil de gestion</h3>
                            </div>
                            <p class="fw-lighter fs-10">Profitez de fonctionnalités avancées pour gérer efficacement votre collection de livres. Notre système offre des outils puissants pour organiser, rechercher et suivre vos livres avec précision.</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-laptop fa-2x me-3 text-primary"></i>
                                <h3 class="text-primary fw-light text-uppercase m-0">Synchronisation multi-appareils</h3>
                            </div>
                            <p class="fw-lighter fs-10">Accédez à votre collection de livres à partir de n'importe quel appareil. Notre système offre une synchronisation fluide entre les appareils, vous permettant de consulter et de mettre à jour votre bibliothèque où que vous soyez.</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-arrow-repeat fa-2x me-3 text-primary"></i>
                                <h3 class="text-primary fw-light text-uppercase m-0">Actualisations régulières et améliorations continues</h3>
                            </div>
                            <p class="fw-lighter fs-10">Profitez des mises à jour fréquentes et des améliorations continues de notre plateforme. Nous nous engageons à fournir une expérience de gestion de bibliothèque toujours meilleure, en ajoutant de nouvelles fonctionnalités et en écoutant les commentaires de nos utilisateurs.</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-badge fa-2x me-3 text-primary"></i>
                                <h3 class="text-primary fw-light text-uppercase m-0">Support client exceptionnel</h3>
                            </div>
                            <p class="fw-lighter fs-10">Notre équipe de support dévouée est là pour vous aider à tout moment. Que vous ayez besoin d'aide pour utiliser la plateforme ou que vous ayez des questions sur la gestion de votre collection, nous sommes là pour vous fournir une assistance rapide et efficace.</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-5" id="caracteristiques">
                <div class="container">
                    <h3 class="fw-light text-uppercase text-center">Fonctionnalités de gestion</h3>
                    <hr class="w-25 mx-auto mb-4">
                    <div class="row gy-4 mt-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-center">
                                        <i class="bi bi-plus-circle fa-2x text-primary me-3"></i>
                                        <h5 class="m-0">Ajouter des livres</h5>
                                    </div>
                                    <p class="card-text">Ajoutez facilement de nouveaux livres à votre collection en saisissant les détails du livre tels que le titre, l'auteur, le genre, et bien plus encore. Notre système vous permet d'ajouter des livres de manière rapide et efficace, vous aidant ainsi à enrichir votre bibliothèque avec vos titres préférés.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-center">
                                        <i class="bi bi-pencil-square fa-2x me-3 text-warning"></i>
                                        <h5 class="m-0">Mettre à jour des livres</h5>
                                    </div>
                                    <p class="card-text">Modifiez les détails de vos livres existants à tout moment. Que vous souhaitiez mettre à jour les informations sur l'auteur, changer le genre d'un livre ou ajouter des notes personnelles, notre plateforme vous offre la flexibilité nécessaire pour maintenir votre collection de livres à jour.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-center">
                                        <i class="bi bi-trash-fill fa-2x text-danger me-3"></i>
                                        <h5 class="m-0">Supprimer des livres</h5>
                                    </div>
                                    <p class="card-text">Supprimez facilement les livres que vous ne souhaitez plus inclure dans votre collection. Que ce soit pour faire de la place pour de nouveaux titres ou pour gérer votre collection de manière plus ciblée, notre système vous permet de supprimer des livres en quelques clics, sans tracas.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-5 bg-light" id="faq">
                <div class="container">
                    <h3 class="fw-light text-uppercase text-center">Foires aux questions</h3>
                    <hr class="w-25 mx-auto mb-4">
                    <div class="row gy-4 mt-3">
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-question-circle fa-2x me-3 text-primary"></i>
                                <p class="fw-bold m-0">Comment puis-je ajouter un livre à ma collection ?</p>
                            </div>
                            <p class="fw-light">Pour ajouter un livre à votre collection, connectez-vous à votre compte, cliquez sur le bouton <strong>"Ajouter un livre"</strong> et saisissez les détails du livre tels que le titre, l'auteur, le genre, etc. Une fois que vous avez rempli les informations nécessaires, cliquez sur le bouton "Ajouter" et le livre sera ajouté à votre bibliothèque.</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-question-circle fa-2x me-3 text-primary"></i>
                                <p class="fw-bold m-0">Comment puis-je modifier les détails d'un livre existant ?</p>
                            </div>
                            <p class="fw-light">Pour modifier les détails d'un livre existant, accédez à votre bibliothèque, trouvez le livre que vous souhaitez modifier, puis cliquez sur l'option <strong>"Modifier"</strong>. Vous pourrez ensuite mettre à jour les informations telles que le titre, l'auteur, le genre, etc. Une fois les modifications effectuées, enregistrez les changements et les détails du livre seront mis à jour dans votre collection.</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-question-circle fa-2x me-3 text-primary"></i>
                                <p class="fw-bold m-0">Comment puis-je supprimer un livre de ma collection ?</p>
                            </div>
                            <p class="fw-light">Pour supprimer un livre de votre collection, accédez à votre bibliothèque, trouvez le livre que vous souhaitez supprimer, puis cliquez sur l'option <strong>"Supprimer"</strong>. Veuillez noter que cette action est irréversible, alors assurez-vous de vouloir réellement supprimer le livre.</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-question-circle fa-2x me-3 text-primary"></i>
                                <p class="fw-bold m-0">Quels types de livres puis-je ajouter à ma collection ?</p>
                            </div>
                            <p class="fw-light">Vous pouvez ajouter une large gamme de livres à votre collection, y compris des <strong>romans</strong>, des <strong>lettres</strong>, des <strong>bandes dessinées</strong>. Notre plateforme prend en charge différents formats de livres pour répondre à vos besoins de lecture variés.</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-question-circle fa-2x me-3 text-primary"></i>
                                <p class="fw-bold m-0">Comment puis-je contacter le support client en cas de problème ?</p>
                            </div>
                            <p class="fw-light">Si vous rencontrez un problème ou si vous avez besoin d'aide, vous pouvez contacter notre équipe de support client en envoyant un e-mail à <strong>fariscastrochabi@gmail.com</strong>. Nous serons heureux de vous aider avec toutes vos questions ou préoccupations.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class="border-top">
            <div class="container py-5">
                <div class="row gy-4 align-items-center">
                    <div class="col-12 col-md-4">
                        <a href="index.php" class="navbar-brand text-primary fw-bold">
                            <span class="bg-primary bg-gradient p-1 rounded-3 text-light">Book</span>Hub
                        </a>
                    </div>
                    <div class="col-12 col-md-4 text-md-center">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#modalMentionsLegales">
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
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-4 text-md-end">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/" target="_blank" class="text-decoration-none text-dark" data-bs-toggle="tooltip" data-bs-title="Linkedin">
                                    <i class="fab fa-linkedin fa-2x" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/" target="_blank" class="text-decoration-none text-dark" data-bs-toggle="tooltip" data-bs-title="Facebook">
                                    <i class="fab fa-facebook-square fa-2x" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://twitter.com/" target="_blank" class="text-decoration-none text-dark" data-bs-toggle="tooltip" data-bs-title="Twitter">
                                    <i class="fab fa-twitter-square fa-2x" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>        

        <!-- Bootstrap JS bundle -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
                crossorigin="anonymous">
        </script>
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) 
            {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    </body>
</html>