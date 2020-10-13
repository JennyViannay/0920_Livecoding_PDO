<?php 
include 'includes/header.php'; 
require '../../function.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = [
        'name' => $_POST["name"],
        'address' => $_POST["address"],
        'total' => getTotalCart(),
        'created_at' => date('Y-m-d')
    ];
    payment($data);
}

?>
<div class="container mt-5">
    <div class="jumbotron">
        <h1 class="display-4">Votre commande est validée</h1>
        <hr class="my-4">
        <!-- Ici c'est grave la merde partez -->
        <a href="../index.php">Revenir au shop</a>
    </div>
</div>
<?php include('includes/footer.php') ?>