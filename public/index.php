<?php
include 'views/includes/header.php';
require '../function.php';
// Grace à $_SERVER je peux tester la methode de la requête qui est envoyée 
// SI la request method du server est GET alors 
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    // Je vérifie 
    // Si dans $_GET la clé article n'est pas vide  
    if(!empty($_GET['article'])){
        $article = $_GET['article'];
        // je fais appel à la méthode addArticle de mon fichier function.php 
        //qui permet d'ajouter et/ou d'incrémenter la qty des articles déjà présent dans le panier
        addArticle($article); 
    }
}
?>
<div class="container">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="https://photos6.spartoo.com/photos/682/6821867/6821867_1200_A.jpg" class="card-img-top" alt="air max 270">
                    <div class="card-body text-center">
                        <form method="GET">
                            <h5 class="card-title">Air max 270 green</h5>
                            <input type="text" class="d-none" name="article" value="AirMax_270_green">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i></a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="https://photos6.spartoo.com/photos/682/6821867/6821867_1200_A.jpg" class="card-img-top" alt="air max 270">
                    <div class="card-body text-center">
                        <form method="GET">
                            <h5 class="card-title">Air max 270 white</h5>
                            <input type="text" class="d-none" name="article" value="AirMax_270_white">

                            <button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i></a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="https://photos6.spartoo.com/photos/682/6821867/6821867_1200_A.jpg" class="card-img-top" alt="air max 270">
                    <div class="card-body text-center">
                        <form method="GET">
                            <h5 class="card-title">Air max 270 red</h5>
                            <input type="text" class="d-none" name="article" value="AirMax_270_red">
                            <input type="text" class="d-none" name="price" value="220">

                            <button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i></a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="https://photos6.spartoo.com/photos/682/6821867/6821867_1200_A.jpg" class="card-img-top" alt="air max 270">
                    <div class="card-body text-center">
                        <form method="GET">
                            <h5 class="card-title">Air max 270 blue</h5>
                            <input type="text" class="d-none" name="article" value="AirMax_270_blue">
                            <input type="text" class="d-none" name="price" value="220">

                            <button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('views/includes/footer.php') ?>