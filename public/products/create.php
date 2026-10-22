<?php

/**  @var $pdo PDO */

require_once '../../database.php';
require_once '../../functions.php';

$errors = [];

$title = '';
$price = '';
$description = '';
$product = [
        'image' => ''
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($errors)) {

        require_once '../../validade_product.php';

        $statement = $pdo->prepare("INSERT INTO products (title, description, image, price, create_date)
               VALUES (:title, :description, :image, :price, :date)");

        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));

        $statement->execute();

        header('Location: index.php');
    }
}

?>

<?php include_once '../../views/partials/header.php' ?>

<body>
    <h1>Create New Product</h1>

    <p>
        <a href="index.php" class="btn btn-secondary">Back to products</a>
    </p>

    <?php include_once '../../views/products/form.php' ?>

</body>
</html>