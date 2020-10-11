<?php
// Ajouter connce.php
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
    if (!empty($cart[$article])) {
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
    foreach (getCartInfos() as $item) {
        $total += $item['qty'] * 270;
    }
    return $total;
}

// GET ALL ARTICLES 
function getAllArticles()
{
    // Initialiser $pdo => connect to bdd
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // Request SQL
    $querySql = "SELECT * FROM article";
    try {
        // Envoyer la request query
        $sendRequest = $pdo->query($querySql);
        // Fetch result fetchAll FETCH_ASSOC permet d'obtenir un array associatif type key => value 
        $articles = $sendRequest->fetchAll(PDO::FETCH_ASSOC);
        // Return le résultat
        return $articles;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}

// SEARCH ARTICLES
function searchArticles($searchTerm)
{
    // Initialiser $pdo => connect to bdd
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    try {
        // Concaténation du terme rechercher avec le symbol SQL % (DOC SQL METHODE LIKE)
        $search = $searchTerm . "%";
        // Requête qui prend des param depuis client, on utilise alors 
        // une méthode préparée pour plus de sécurité param est défini par :nom_du_param
        $request = $pdo->prepare("SELECT * FROM article WHERE name LIKE :search ORDER BY name ASC");
        // On execute la requete en applicant les param ici :search devient 'search' 
        // et la valeur du terme recherché est récupérée depuis $search 
        $request->execute([
            'search' => $search
        ]);
        // Fetch result fetchAll FETCH_ASSOC permet d'obtenir un array associatif type key => value 
        $articles = $request->fetchAll(PDO::FETCH_ASSOC);
        // Return le résultat
        return $articles;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}

// GET ONE ARTICLE 
function getOneArticle($id)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $request ="SELECT * FROM article WHERE id=$id";
    $sendRequest = $pdo->query($request);
    $article = $sendRequest->fetchObject();
    return $article;
}

// PAYMENT METHOD => INSERT NEW COMMAND IN BDD
function payment($infos)
{
    $name = $infos['name'];
    $address = $infos['address'];
    $total = getTotalCart();
    $date = date("Y-m-d");
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    try {
        $postCommand = $pdo->prepare("INSERT INTO command (name, address, total, created_at) VALUES (:name, :address, :total, :created_at);");
        $postCommand->execute([
            'name' => $name,
            'address' => $address,
            'total' => $total,
            'created_at' => $date
        ]);
        session_destroy();
        return header('Location: http://localhost:8005/views/success.php');
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}
