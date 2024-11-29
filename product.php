<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>

<main>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM products WHERE id=$id");
        $product = $result->fetch_assoc();

        if ($product) {
            echo "
                <div class='product-detail'>
                    <img src='{$product['img/product1.jpg']}' alt='{$product['name']}'>
                    <h2>{$product['name']}</h2>
                    <p>{$product['description']}</p>
                    <p>Rp " . number_format($product['price'], 0, ',', '.') . "</p>
                    <form action='cart.php' method='POST'>
                        <input type='hidden' name='product_id' value='{$product['id']}'>
                        <input type='number' name='quantity' value='1' min='1'>
                        <button type='submit'>Add to Cart</button>
                    </form>
                </div>
            ";
        } else {
            echo "<p>Product not found!</p>";
        }
    } else {
        echo "<p>Invalid product!</p>";
    }
    ?>
</main>

<?php include('includes/footer.php'); ?>
