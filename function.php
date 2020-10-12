<?php

require 'connec.php';

function addArticle($article)
{
    if (!empty($_SESSION['cart'][$article])) {
        $_SESSION['cart'][$article]++;
    } else {
        $_SESSION['cart'][$article] = 1;
    }
    // Ici pas de rechargement de page sans resoumettre le formulaire
    // La redirection est là pour que la page soit rechargée
    // entièrement et que les élèments front se mettent à jour (barre de navigation etc...)
    header('Location: http://localhost:8005/index.php');
}

function deleteArticle($article)
{
    $cart = $_SESSION['cart'];
    if(!empty($cart[$article])){
        unset($cart[$article]);
    }
    $_SESSION['cart'] = $cart;
    header('Location: http://localhost:8005/views/cart.php');
}

function getCartInfos()
{
    $cart = $_SESSION['cart'];
    $cartInfos = [];
    foreach ($cart as $article => $qty) {
        $cartInfos[] = [
            'product' => $article,
            'qty' => $qty
        ];
    }
    return $cartInfos;
}

function getTotalCart()
{
    $total = 0;
    foreach(getCartInfos() as $item){
        $total += $item['qty'] * 270;
    }
    return $total;
}

// GET ALL ARTCILE FROM BDD
function getAllArticles()
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = "SELECT * FROM article;";
    try {
        $sendRequest = $pdo->query($query);
        $articles = $sendRequest->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    } catch (PDOException $e) {
        return $error = $e->getMessage();
    }
}

// GET ONE ARTICLE FROM BDD
function getOneArticle($id)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = "SELECT * FROM article WHERE id=$id;";
    try {
        $sendRequest = $pdo->query($query);
        $article = $sendRequest->fetchObject();
        return $article;
    } catch (PDOException $e) {
        return $error = $e->getMessage();
    }
}

// SEARCH TERM IN BDD ARTICLES 
function search($term)
{
    $searchTerm = $term.'%';
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $statement = $pdo->prepare("SELECT * FROM article WHERE name LIKE :search ORDER BY name ASC");
    $statement->execute([
        'search' => $searchTerm
    ]);
    return $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
}
