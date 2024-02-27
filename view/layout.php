<?php

use App\Session;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title><?= $result['titrePage'] ?></title>
    <link rel="stylesheet" href="<?= CSS_PATH ?>style.css">
</head>

<body>
    <div class="global">
        <header>
            <nav class="navbar navbar-expand-sm bg-info navbar-dark p-3">
                <div class="logos">
                    <div class="logo">
                        <a class="navbar-brand" href="?ctrl=accueil&method=allCategories">
                            <img src="<?= IMG_PATH ?>home.png" width="30" height="30" alt="Logo" loading="lazy">
                        </a>
                    </div>
                    <form class="form-inline" method="POST" action="?ctrl=forum&method=search">
                        <input class="form-control mr-sm-2" name="q" type="text" placeholder="Entrez ce que vous chercher">
                        <button class="btn btn-success" type="submit">Rechercher</button>
                        <input type="hidden" name="token" value=<?= $token ?>>
                    </form>
                    <div class="liens">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#"><img width="30" height="30" src="<?= IMG_PATH ?>contact.png" alt="Contact"></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#"><img width="30" height="30" src="<?= IMG_PATH ?>help.png" alt="Aide"></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#"><img width="30" height="30" src="<?= IMG_PATH ?>instagram.png" alt="twitter"></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#"><img width="30" height="30" src="<?= IMG_PATH ?>face.png" alt="facebook"></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#"><img width="30" height="30" src="<?= IMG_PATH ?>twitter.png" alt="instagram"></a>
                            </li>
                    </div>
                </div>
            </nav>
            <div class="forum">
                <img width="80" height="80" src="<?= IMG_PATH ?>image.png" alt="">
                <img width="100%" height="80" src="<?= IMG_PATH ?>sat.png" alt="">
                <img width="80" height="80" src="<?= IMG_PATH ?>image.png" alt="">
            </div>
            <nav class="navbar navbar-expand-sm bg-info navbar-dark p-2">
                <div class="logos">
                    <div class="logo">
                        <?php
                        if (Session::getUtilisateur()) { ?>
                            <a class="navbar-brand" href="?ctrl=utilisateur&method=userDetail&id=<?= Session::getUtilisateur()->getId() ?>">
                                <?= "<h4>Bienvenue <span style='color: goldenrod;'>" . Session::getUtilisateur()->getPsuedo() . "</span></h4>" . Session::herarchie() ?>
                                <a href="?ctrl=security&method=logout"><button type="button" class="btn btn-warning mr-2">Deconnexion</button></a>
                            <?php
                        } else {   ?>
                                <div class="headerhaut">
                                    <span>Bonjour,<a href="?ctrl=security&method=loginForm"> Se connecter</a></span>
                                    <form action="?ctrl=security&method=login" method="POST">
                                        <input type="text" name="psuedo" placeholder="IDENTIFIANT">
                                        <input type="password" name="password" placeholder="MOT DE PASSE">
                                        <input type="hidden" name="token" value=<?= $token ?>>
                                        <button>
                                            Connexion
                                        </button>
                                    </form>
                                    <span>ou vous pouvez <a href="?ctrl=security&method=registerForm"> S\'inscrire</a></span>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="liens">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="?ctrl=forum&method=listSujets&p=1">Liste Sujets</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="?ctrl=message&method=DerniersMessages&p=1">Derniers Messages</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="?ctrl=forum&method=latestUsers&p=1">Nouveaux Membres</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="?ctrl=forum&method=TopSujetsStat"> Sujets Populaires</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="?ctrl=forum&method=TopUsersStat">Membres Actifs</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="?ctrl=forum&method=sujetsCount">Nombre Sujets</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="?ctrl=forum&method=messagesCount">Nombre Messages</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="?ctrl=forum&method=UsersCount">Nombre Membres</a>
                            </li>
                    </div>
                </div>
            </nav>
        </header>
        <div id="meteo">
            <span id="commune"></span>
            <select name="" id="" class="met">
            </select>
        </div>
        <main>

            <div>
                <?php
                $message = match (true) {
                    Session::flash('success') => Session::flash('success'),
                    Session::flash('error') => Session::flash('error'),
                    Session::flash('info') => Session::flash('info'),
                    Session::flash('warning') => Session::flash('warning'),
                    default => Session::flash('info')
                };
                echo $message;
                ?>

            </div>
            <div id="page">
                <?= $page ?>
            </div>
        </main>
        <footer id="pied">
            Forum SatForum réalisé avec PHP_POO et MVC par le Stagiaire @AIT M'HAMED <br>&copy;2020 - SatForum.<br>
        </footer>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="<?= JS_PATH ?>script.js"></script>
</body>

</html>