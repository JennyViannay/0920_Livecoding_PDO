<?php
include 'includes/header.php';
require '../../function.php';

$article = null;

if(isset($_GET['id']) && !empty($_GET['id'])){
    $article = getOneArticle($_GET['id']);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!empty($_POST['name']) && !empty($_POST['img']) && !empty($_POST['price'])){
        if(isset($_POST['create'])){
            createArticle($_POST);
        }
        if(isset($_POST['update'])){
            updateArticle($_POST);
        }
    }
}

?>
<div class="container">
    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $article ? $article->name : "" ?>">
        </div>
        <div class="form-group">
            <label for="img">Picture</label>
            <input type="text" class="form-control" id="img" name="img" value="<?= $article ? $article->img : "" ?>">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= $article ? $article->price : "" ?>">
        </div>
        <input type="text" class="d-none" name="id" value="<?= $article ? $article->id : "" ?>">
        <?php if($article === null) { ?>
        <button type="submit" name="create" class="btn btn-primary">Create</button>
        <?php } else { ?>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <?php } ?>
    </form>
</div>
<?php include('includes/footer.php') ?>