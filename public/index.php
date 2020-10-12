<?php
include 'views/includes/header.php';
require '../function.php';

$articles = getAllArticles();
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(!empty($_GET['article'])){
        $article = $_GET['article'];
        addArticle($article); 
    }
}
if(isset($_GET['search']) && !empty($_GET['search']) ){
    $searchTerm = $_GET['search'];
    $articles = search($searchTerm);
}
?>
<div class="container">
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
                    <div class="card-footer text-center">
                        <a href=<?php echo "views/article.php?id=".$article['id'] ?> class="btn btn-success"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
    <?php include('views/includes/footer.php') ?>