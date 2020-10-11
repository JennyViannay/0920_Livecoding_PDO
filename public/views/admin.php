<?php
include 'includes/header.php';
require '../../function.php';
require '../../admin_function.php';
// GET ALL COMMAND IN TABLE 
$commands = getAllCommand();
// GET ALL ARTICLES IN TABLE
$articles = getAllArticles();
// => CRUD ARTICLES
// DELETE ARTICLE
if(isset($_GET['delete_article_id'])){
    $id = $_GET['delete_article_id'];
    deleteArticleFromBdd($id);
}
?>

<div class="container mt-5">
    <div class="jumbotron my-5 bg-dark text-white">
        <h2 class="display-4">Commands :</h2>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Total</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commands as $command) { ?>
                <tr>
                    <th scope="row"><?php echo $command['id']; ?></th>
                    <td><?php echo $command['name']; ?></td>
                    <td><?php echo $command['address']; ?></td>
                    <td><?php echo $command['total']; ?></td>
                    <td><?php echo $command['created_at']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="jumbotron my-5 bg-dark text-white">
        <h2 class="display-4">Articles :</h2>
        <div class="text-right my-3">
            <a href="edit_article.php" class="btn btn-sm btn-primary">New <i class="fas fa-plus-circle"></i></a>
        </div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Img</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article) { ?>
                <tr>
                    <th scope="row"><?php echo $article['id']; ?></th>
                    <td><?php echo $article['name']; ?></td>
                    <td><?php echo $article['price'] ." $"; ?></td>
                    <td><img src="<?php echo $article['img']; ?>" alt="" class="img-fluid" width="150px"></td>
                    <td>
                        <a href=<?php echo "article.php?id=".$article['id'] ?> class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                        <a href=<?php echo "edit_article.php?id=".$article['id'] ?> class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href=<?php echo "admin.php?delete_article_id=".$article['id'] ?> class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('includes/footer.php') ?>