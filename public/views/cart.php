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
?>

<div class="container mt-5">
    <!-- Conditions d'affichage de la page panier : 
    SI LE $_SESSION['CART'] n'est pas vide alors j'affiche le détail du panier -->
    <?php if(!empty($_SESSION['cart'])){ ?>
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
            for ($i = 0; $i < count($cartInfos); $i++) {
            ?>
            <!-- A l'interieur de la boucle j'en profite pour afficher chaque ligne de mon panier toujours depuis cartInfos -->
                <tr>
                    <th scope="row">#</th>
                    <td><?php echo $cartInfos[$i]['product'] ?></td>
                    <td><?php echo $cartInfos[$i]['qty'] ?></td>
                    <td><?php echo $cartInfos[$i]['price'] ?> $</td>
                    <td><?php echo $cartInfos[$i]['qty'] * $cartInfos[$i]['price'] ?> $</td>
                    <td>
                        <form method="GET">
                            <input type="text" class="d-none" name="article" value="<?php echo $cartInfos[$i]['id'] ?>">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="jumbotron">
        <!-- J'affiche le résultat du total ici -->
        <h1 class="display-4">Total panier : <?= getTotalCart() ?> $ </h1>
        <hr class="my-4">
        <form method="POST" action="success.php">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" class="form-control" name="address" id="address">
            </div>
            <button type="submit" class="btn btn-primary">Valider mon panier</button>
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