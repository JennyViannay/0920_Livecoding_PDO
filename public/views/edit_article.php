<?php
include 'includes/header.php';
require '../../function.php';
require '../../admin_function.php';

$article = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $article = getOneArticle($id);
}

// UPDATE
$errorForm = null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['img']) && !empty($_POST['id'])) {
        updateArticle($_POST);
    } elseif (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['img']) && !isset($_POST['id'])) {
        createArticle($_POST);
    } else {
        $errorForm = 'Tous les champs sont obligatoires.';
    }
}
?>
<div class="container">
    <div class="container mt-5">
        <div class="row">
            <?php if ($article != null) { ?>
                <h2 class="display-4">Update Article #<?= $article->id ?></h2>
                <hr>
                <div class="col-12">
                    <?php if ($errorForm != null) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $errorForm; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-12">
                    <form method="POST">
                        <input type="text" class="d-none" id="id" name="id" value="<?php echo $article->id; ?>">
                        <div class="form-group">
                            <label for="Name">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $article->name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="price">Price *</label>
                            <input type="text" class="form-control" id="price" name="price" value="<?php echo $article->price; ?>">
                        </div>
                        <div class="form-group">
                            <label for="price">Picture *</label>
                            <input type="text" class="form-control" id="img" name="img" value="<?php echo $article->img; ?>">
                        </div>
                        <div class="small">* Champs obligatoires</div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            <?php } else { ?>
                <h2 class="display-4">Create Article #?</h2>
                <hr>
                <div class="col-12">
                    <?php if ($errorForm != null) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $errorForm; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-12">
                    <form method="POST">
                        <div class="form-group">
                            <label for="Name">Name *</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="price">Price *</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="price">Picture *</label>
                            <input type="text" class="form-control" id="img" name="img">
                        </div>
                        <div class="small">* Champs obligatoires</div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            <?php } ?>

        </div>
    </div>
    <?php include('includes/footer.php') ?>