<?php 
session_start(); 
// Calculer le nombre d'articles dans le panier : 
// Nouvelle variable $numberArticle à 0
// Boucler sur les élèments du panier depuis la session en cours
// A chaque tour de boucle j'ajoute la valeur des quantités d'articles à $numberArticles
// $numberArticle est à jour en fonction des qty d'articles que j'ai dans mon panier 
$numberArticles = 0;
if(!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $article => $qty) {
        $numberArticles += $qty;
    }
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Livecoding PDO</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/12c728ad22.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- mon style -->
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Livecoding PDO </a>
        <ul class="nav">
            <li class="nav-item">
                <!-- CONDITIONS D'AFFICHAGE : 
                Si ma session cat n'est pas vide j'affiche panier + count du panier -->
                <?php if(!empty($_SESSION['cart'])){ ?>
                    <a href="../views/cart.php" class="nav-link btn">
                        <i class="fas fa-shopping-cart"></i> 
                        <span class="badge badge-danger"><?php echo $numberArticles; ?></span>
                    </a>
                <!-- Sinon juste panier -->
                <?php } else { ?>
                    <a href="../views/cart.php" class="nav-link btn"><i class="fas fa-shopping-cart"></i></a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <a href="../views/admin.php" class="nav-link btn"><i class="fas fa-user-ninja"></i></a>
            </li>
        </ul>
    </nav>