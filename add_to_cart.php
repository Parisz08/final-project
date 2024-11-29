<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if ($product_id > 0 && $quantity > 0) {
        $query = "SELECT id, quantity FROM cart WHERE product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $new_quantity = $row['quantity'] + $quantity;
            $update_query = "UPDATE cart SET quantity = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ii", $new_quantity, $row['id']);
            $update_stmt->execute();
            $update_stmt->close();
        } else {
            $insert_query = "INSERT INTO cart (product_id, quantity) VALUES (?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("ii", $product_id, $quantity);
            $insert_stmt->execute();
            $insert_stmt->close();
        }

        $stmt->close();
    }

    header("Location: cart.php");
    exit;
} else {
    echo "Invalid request!";
}
?>
