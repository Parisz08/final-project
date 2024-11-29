<?php
include('includes/db.php');
include('includes/header.php');

// Hapus barang dari keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item_id'])) {
    $delete_item_id = intval($_POST['delete_item_id']);
    $query = "DELETE FROM cart WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $delete_item_id);
    $stmt->execute();
    $stmt->close();
}

// Ambil barang di keranjang
$query = "
    SELECT cart.id, products.name, products.price, cart.quantity 
    FROM cart 
    JOIN products ON cart.product_id = products.id
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Your Cart</h1>
    <div class="cart">
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($item = $result->fetch_assoc()): ?>
                    <li>
                        <?php echo $item['name']; ?> - Rp <?php echo number_format($item['price'], 0, ',', '.'); ?> x <?php echo $item['quantity']; ?>
                        <form method="POST">
                            <input type="hidden" name="delete_item_id" value="<?php echo $item['id']; ?>">
                            <button type="submit">Delete</button>
                            <a href="checkout.php" class="checkout-btn">Checkout</a>
                        </form>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Your cart is empty!</p>
        <?php endif; ?>
    </div>
    <a href="index.php">Back to Products</a>
</body>
</html>


<?php 
include('includes/footer.php');
?>