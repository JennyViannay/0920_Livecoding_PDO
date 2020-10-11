<?php
include 'views/includes/header.php';
require '../function.php';
// Grace à $_SERVER je peux tester la methode de la requête qui est envoyée 
// SI la request method du server est GET alors 
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Je vérifie 
    // Si dans $_GET la clé article n'est pas vide  
    if (!empty($_GET['article'])) {
        $article = $_GET['article'];
        // je fais appel à la méthode addArticle de mon fichier function.php 
        //qui permet d'ajouter et/ou d'incrémenter la qty des articles déjà présent dans le panier
        addArticle($article);
    }
}
// Faire appel à la méthode getAllArticles qui permets d'obtenir tous les articles en bDD
$articles = getAllArticles();
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $articles = searchArticles($_GET['search']);
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 my-5">
            <form>
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" id="search" name="search" placeholder="ex : nike">
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></i></button>
                    </div>
                </div>
                <div class="text-right">
                    <a href="index.php">Tous les articles</a>
                </div>
            </form>
        </div>
        <?php foreach ($articles as $article) { ?>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="<?php echo $article['img']; ?>" class="card-img-top" alt="air max 270">
                    <div class="card-body text-center">
                        <form method="GET">
                            <h5 class="card-title"><?php echo $article['name']; ?></h5>
                            <p><?php echo $article['price'] . " $"; ?></p>
                            <input type="text" class="d-none" name="article" value="<?php echo $article['id']; ?>">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i></button>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                        <a href=<?php echo "views/article.php?id=".$article['id'] ?> class="btn btn-success">Voir</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include('views/includes/footer.php') ?>