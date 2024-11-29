<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css\checkout.css">
</head>
<body>
<div class="container">
    <h1>Checkout</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Product 1</td>
                <td>2</td>
                <td>Rp 100.000</td>
                <td>Rp 200.000</td>
            </tr>
            <tr>
                <td>Product 2</td>
                <td>1</td>
                <td>Rp 150.000</td>
                <td>Rp 150.000</td>
            </tr>
        </tbody>
    </table>
    <div class="total-container">
        Total: <span>Rp 350.000</span>
    </div>
    <a href="payment.php" class="checkout-button">Proceed to Payment</a>
    <a href="index.php" class="back-link">Back to Shop</a>
</div>

</body>
</html>
<?php
session_start();
include 'config.php'; // Koneksi ke database

// Cek apakah keranjang tidak kosong
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty. <a href='index.php'>Go back to shop</a>";
    exit;
}

// Hitung total harga keranjang
$total_price = 0;
foreach ($_SESSION['cart'] as $product_id => $product) {
    $total_price += $product['price'] * $product['quantity'];
}

// Simpan pesanan ke tabel orders
$user_id = 1; // Ganti sesuai sistem user login Anda (hardcoded sementara)
$query = "INSERT INTO orders (user_id, total_price) VALUES ('$user_id', '$total_price')";
mysqli_query($conn, $query);
$order_id = mysqli_insert_id($conn); // ID pesanan yang baru dimasukkan

// Simpan detail barang ke tabel order_items
foreach ($_SESSION['cart'] as $product_id => $product) {
    $quantity = $product['quantity'];
    $price = $product['price'];
    $query = "INSERT INTO order_items (order_id, product_id, quantity, price) 
    
              VALUES ('$order_id', '$product_id', '$quantity', '$price')";
    mysqli_query($conn, $query);
}

// Kosongkan keranjang setelah checkout
unset($_SESSION['cart']);

// Tampilkan konfirmasi kepada pengguna
echo "<h1>Checkout Successful!</h1>";
echo "<p>Your order has been placed successfully. Order ID: $order_id</p>";
echo "<a href='index.php'>Continue Shopping</a>";
?>