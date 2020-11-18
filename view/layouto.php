
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= CSS_PATH ?>style.css">
    <title>forum</title>
</head>

<body>

    <div id="wrapper">
        <nav>
            <img src="<?= IMG_PATH ?>monimage.png">
            <a href="?ctrl=home&method=index">Home</a>
            
                <a href="?ctrl=security&method=logout">Déconnexion</a>
                <a href="?ctrl=home&method=listTopics">Liste des topics</a>
                <a href="?ctrl=home&method=listCategorie">Liste des categories</a>
                <a href="?ctrl=home&method=create">créer un topic </a>
           
                <a href="?ctrl=security&method=login">Connexion</a>
                <a href="?ctrl=security&method=register">Inscription</a>
         
        </nav>
        <main>
            <h1>Forum</h1>
        

            <div id="page">
               <?= $page ?>
            </div>
        </main>

        <footer>
            <p>
                &copy;2020 - WESH WESH !
            </p>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>