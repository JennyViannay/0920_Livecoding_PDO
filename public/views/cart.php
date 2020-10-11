<?php
include 'includes/header.php';
require '../../function.php';
// Je récupère les infos panier depuis la methode getCartInfos du fichier function.php
// Qui permet d'avoir un array de type clé => valeur
// Dans mon cas 'nom_de_l'article' => 'qty'
if(!empty($_SESSION['cart'])){
    $cartInfos = getCartInfos();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['article'])) {
        deleteArticle($_GET['article']);
    }
}

$errorForm = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['address'])) {
        payment($_POST);
    } else {
        $errorForm = "Tous les champs sont obligatoires !";
    }
}
?>

<div class="container mt-5">
    <!-- Conditions d'affichage de la page panier : 
    SI LE $_SESSION['CART'] n'est pas vide alors j'affiche le détail du panier -->
    <?php if (!empty($_SESSION['cart'])) { ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Modele</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ici plusieurs manières d'obtenir le total du panier 
                // Initialise une var $total à 0
                // Puis boucle sur les éléments du panier ($cartInfos) et pour chaque tour de boucle 
                // J'incrémente $total du montant du prix multiplié par la qty de l'article 
                $total = 0;
                for ($i = 0; $i < count($cartInfos); $i++) {
                    $total += $cartInfos[$i]['qty'] * 270;
                ?>
                    <!-- A l'interieur de la boucle j'en profite pour afficher chaque ligne de mon panier toujours depuis cartInfos -->
                    <tr>
                        <th scope="row">#</th>
                        <td><?php echo $cartInfos[$i]['product'] ?></td>
                        <td><?php echo $cartInfos[$i]['qty'] ?></td>
                        <td>270 $</td>
                        <td><?php echo $cartInfos[$i]['qty'] * 270 ?> $</td>
                        <td>
                            <form method="GET">
                                <input type="text" class="d-none" name="article" value="<?php echo $cartInfos[$i]['product'] ?>">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <h1 class="display-4 mb-5">Total panier : <?php echo $total; // ou echo getCartTotal() depuis le fichier function.php 
                                                    ?> $ </h1>
        <div class="jumbotron my-5">
            <h2 class="display-4">Paiement :</h2>
            <!-- J'affiche le résultat du total ici -->
            <?php if ($errorForm != null) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorForm; ?>
                </div>
            <?php } ?>
            <hr class="my-4">
            <form method="POST">
                <div class="form-group">
                    <label for="firstname">Nom *</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="address">Adresse *</label>
                    <input type="text" class="form-control" name="address" id="address">
                </div>
                <div class="small">* Champs obligatoires</div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Valider mon panier</button>
                </div>
            </form>
        </div>
        <!-- Conditions d'affichage de la page panier : 
    SINON J'AFFICHE PANIER VIDE -->
    <?php } else { ?>
        <div class="jumbotron">
            <h1 class="display-4">Votre panier est vide </h1>
        </div>
    <?php } ?>
</div>
<?php include('includes/footer.php') ?>