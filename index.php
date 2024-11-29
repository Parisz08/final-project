<?php
include('includes/db.php');
include('includes/header.php');

// Ambil data produk
$query = "SELECT * FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Product List</h1>
    <div class="products">
        <?php while ($product = $result->fetch_assoc()): ?>
            <div class="product">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p>Price: Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                <p><?php echo $product['description']; ?></p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="cart.php">Go to Cart</a>
</body>
</html>


<?php 
include('includes/footer.php');
?>