<?php
include 'includes/header.php';
require '../../function.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(!empty($_GET['article'])){
        $article = $_GET['article'];
        addArticle($article); 
    }
}

$article = null;
if(isset($_GET['id'])){
    $article = getOneArticle($_GET['id']);
}
?>
<div class="container">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="<?php echo $article->img; ?>" class="card-img-top" alt="air max 270">
                    <div class="card-body text-center">
                        <form method="GET">
                            <h5 class="card-title"><?php echo $article->name; ?></h5>
                            <p><?php echo $article->price . " $"; ?></p>
                            <input type="text" class="d-none" name="article" value="<?php echo $article->id; ?>">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>