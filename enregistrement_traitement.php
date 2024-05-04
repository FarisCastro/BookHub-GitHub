<?php
    require_once 'config.php';

    if(isset($_POST['genre']) && isset($_POST['nom']) && isset($_POST['adresse']) && $_POST['email'] && $_POST['password'] && $_POST['passwordConfirmer'])
    {
        $genre = htmlspecialchars($_POST['genre']);
        $nom = htmlspecialchars($_POST['nom']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordConfirmer = htmlspecialchars($_POST['passwordConfirmer']);
        
        // Contrôle du genre
        if ($genre == "Genre de bibliothèque" || empty($genre)) { 
            header('Location:enregistrement.php?reg_err=invalid_genre');
            exit; 
        }

        // Vérification de l'existence du genre dans la base de données
        $check_genre = $bdd->prepare('SELECT * FROM genres WHERE id = ?');
        $check_genre->execute(array($genre));
        if ($check_genre->rowCount() == 0) {
            header('Location:enregistrement.php?reg_err=invalid_genre');
            exit; 
        }


        $check = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        if($row == 0)
        {
            if(preg_match('/^[A-Za-z0-9 -]+$/', $nom))
            {
                if(strlen($nom) <= 100)
                {
                    if(strlen($email) <= 100)
                    {
                        if(strlen($adresse))
                        {
                            if(filter_var($email, FILTER_VALIDATE_EMAIL))
                            {
                                if($password == $passwordConfirmer)
                                {
                                    $password = hash('sha256', $password);
                                    $insert = $bdd->prepare('INSERT INTO utilisateurs(genre, nom, adresse, email, password) VALUES(:genre, :nom, :adresse, :email, :password)');
                                    $insert->execute(array(
                                        'genre' => $genre,
                                        'nom' => $nom,
                                        'adresse' => $adresse,
                                        'email' => $email,
                                        'password' => $password    
                                    ));
                                    header('Location:enregistrement.php?reg_err=success');
                                }else header('Location:enregistrement.php?reg_err=password');
                            }else header('Location:enregistrement.php?reg_err=email');
                        }else header('Location:enregistrement.php?reg_err=adr_length');
                    }else header('Location:enregistrement.php?reg_err=email_length');
                }else header('Location:enregistrement.php?reg_err=nom_length');
            }else header('Location:enregistrement.php?reg_err=nom_invalide');
        }else header('Location:enregistrement.php?reg_err=already');
    }else header('Location:enregistrement.php');