<?php

/**  @var $pdo PDO */

require_once '../../database.php';
require_once '../../functions.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare('SELECT * FROM products where id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

$product = $statement->fetch(PDO::FETCH_ASSOC);

$errors = [];

$title = $product['title'];
$price = $product['price'];
$description = $product['description'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../validade_product.php';

    if (empty($errors)) {


        $statement = $pdo->prepare("UPDATE products SET title = :title, description = :description,
                    image = :image, price = :price WHERE id = :id");

        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':id', $id);

        $statement->execute();

        header('Location: index.php');
    }
}

?>

<!doctype html>
<html lang="en">

<?php include_once '../../views/partials/header.php' ?>

<p>
    <a href="index.php" class="btn btn-secondary">Back to products</a>
</p>

<body>

<h1>Update Product <b><?php echo $product['title'] ?></b></h1>

<?php include_once '../../views/products/form.php' ?>

</body>
</html>