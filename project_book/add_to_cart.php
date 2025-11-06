<?php
include 'config.php';
session_start();

if (!isset($_GET['id'])) {
    header('Location: shop.php');
    exit;
}

$product_id = (int)$_GET['id'];

// Fetch product with seller_id
$result = mysqli_query($conn, "
    SELECT p.*, s.seller_id 
    FROM products p
    JOIN seller s ON p.seller_id = s.seller_id
    WHERE p.id = $product_id
") or die('Query failed: '.mysqli_error($conn));

if (mysqli_num_rows($result) == 0) {
    die("Product not found.");
}

$product = mysqli_fetch_assoc($result);

// Verify seller_id exists
if (!isset($product['seller_id'])) {
    die("Seller information missing for this product.");
}

// Store in cart (logged-in users)
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Check if product already in cart
    $check_cart = mysqli_query($conn, "
        SELECT * FROM cart 
        WHERE user_id = '$user_id' AND product_id = '$product_id'
    ") or die('Query failed: '.mysqli_error($conn));

    if (mysqli_num_rows($check_cart) > 0) {
        // Update quantity
        mysqli_query($conn, "
            UPDATE cart 
            SET quantity = quantity + 1 
            WHERE user_id = '$user_id' AND product_id = '$product_id'
        ") or die('Query failed: '.mysqli_error($conn));
    } else {
        // Insert new item with seller_id
        mysqli_query($conn, "
            INSERT INTO cart(
                user_id, 
                seller_id, 
                product_id, 
                name, 
                price, 
                image, 
                quantity
            ) VALUES(
                '$user_id', 
                '{$product['seller_id']}', 
                '$product_id', 
                '{$product['name']}', 
                '{$product['price']}', 
                '{$product['image']}', 
                1
            )
        ") or die('Insert failed: '.mysqli_error($conn));
    }
} 
// Guest cart handling
else {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => 1,
            'seller_id' => $product['seller_id']
        ];
    }
}

header('Location: cart.php');
exit;
?>