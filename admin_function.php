<?php 
// GET ALL COMMAND 
function getAllCommand()
{
    // Initialiser $pdo => connect to bdd
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // Request SQL
    $querySql = "SELECT * FROM command";
    try {
        // Envoyer la request query
        $sendRequest = $pdo->query($querySql);
        // Fetch result fetchAll FETCH_ASSOC permet d'obtenir un array associatif type key => value 
        $commands = $sendRequest->fetchAll(PDO::FETCH_ASSOC);
        // Return le résultat
        return $commands;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}

// CREATE ARTICLE
function createArticle($infos)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $insertArticle = $pdo->prepare("INSERT INTO article (name, price, img) VALUES (:name, :price, :img)");
    $insertArticle->execute([
        'name' => $infos['name'],
        'price' => intval($infos['price']),
        'img' => $infos['img']
        ]);
    header('Location: http://localhost:8005/views/admin.php');
}

// UPDATE ARTICLE 
function updateArticle($infos)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $updateArticle = $pdo->prepare("UPDATE article SET name=:name, price=:price, img=:img WHERE id=:id");
    $updateArticle->execute([
        'name' => $infos['name'],
        'price' => intval($infos['price']),
        'img' => $infos['img'],
        'id' => intval($infos['id']),
    ]);
    header('Location: http://localhost:8005/views/admin.php');
}

// DELETE ARTICLE
function deleteArticleFromBdd($id)
{
    $pdo = new PDO(DSN, USER, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $deleteArticle = $pdo->prepare('DELETE FROM article WHERE id=:id');
    $deleteArticle->execute(['id' => $id]);
    header('Location: http://localhost:8005/views/admin.php');
}
