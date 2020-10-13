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
        $articleInfos = getOneArticle($article);
        $cartInfos[] = [
            'id' => $articleInfos->id,
            'product' => $articleInfos->name,
            'qty' => $qty,
            'price' => $articleInfos->price
        ];
    }
    return $cartInfos;
}

function getTotalCart()
{
    $total = 0;
    foreach(getCartInfos() as $item){
        $total += $item['qty'] * $item['price'];
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

// DELETE ARTICLE FROM BDD
function deleteArticleFromBdd(int $id)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = "DELETE FROM article WHERE id=:id;";
    try {
        $sendRequest = $pdo->prepare($query);
        $sendRequest->bindValue(':id', $id, PDO::PARAM_INT);
        $sendRequest->execute();
        header('Location: http://localhost:8005/views/admin.php');
    } catch (PDOException $e) {
        return $error = $e->getMessage();
    }
}

// CREATE ARTICLE
function createArticle(array $data)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = "INSERT INTO article (name, img, price) VALUES (:name, :img, :price)";
    try {
        $sendRequest = $pdo->prepare($query);
        $sendRequest->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $sendRequest->bindValue(':img', $data['img'], PDO::PARAM_STR);
        $sendRequest->bindValue(':price', $data['price'], PDO::PARAM_INT);
        $sendRequest->execute();
        header('Location: http://localhost:8005/views/admin.php');
    } catch (PDOException $e) {
        return $error = $e->getMessage();
    }
}

// UPDATE ARTICLE
function updateArticle(array $data)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = "UPDATE article SET name=:name, img=:img, price=:price WHERE id=:id";
    try {
        $sendRequest = $pdo->prepare($query);
        $sendRequest->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $sendRequest->bindValue(':img', $data['img'], PDO::PARAM_STR);
        $sendRequest->bindValue(':price', $data['price'], PDO::PARAM_INT);
        $sendRequest->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $sendRequest->execute();
        header('Location: http://localhost:8005/views/admin.php');
    } catch (PDOException $e) {
        return $error = $e->getMessage();
    }
}

function payment(array $data)
{
    session_destroy();
    createCommand($data);
}

// CREATE COMMAND
function createCommand(array $data)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = "INSERT INTO command (name, address, total, created_at) VALUES (:name, :address, :total, :created_at)";
    try {
        $sendRequest = $pdo->prepare($query);
        $sendRequest->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $sendRequest->bindValue(':address', $data['address'], PDO::PARAM_STR);
        $sendRequest->bindValue(':total', $data['total'], PDO::PARAM_INT);
        $sendRequest->bindValue(':created_at', $data['created_at']);
        $sendRequest->execute();
        header('Location: http://localhost:8005/views/admin.php');
    } catch (PDOException $e) {
        return $error = $e->getMessage();
    }
}

// GET ALL COMMAND
function getAllCommands()
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = "SELECT * FROM command;";
    try {
        $sendRequest = $pdo->query($query);
        $commands = $sendRequest->fetchAll(PDO::FETCH_ASSOC);
        return $commands;
    } catch (PDOException $e) {
        return $error = $e->getMessage();
    }
}