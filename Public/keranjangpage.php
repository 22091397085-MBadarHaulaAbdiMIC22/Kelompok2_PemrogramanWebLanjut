<?php
// Include database and cart class
include_once '../classes/Databases.php';
include_once '../classes/tb_keranjang.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize cart object
$keranjang = new Keranjang($db);

// Check if the add to cart form is submitted
if (isset($_POST['add_to_cart'])) {
    // Set cart item properties from the form data
    $user_id = $_POST['user_id'];
    $produk_id = $_POST['produk_id'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    // Attempt to add item to cart
    $keranjang->addToCart($user_id, $produk_id, $harga, $jumlah);
}

// Check if the update cart form is submitted
if (isset($_POST['update_cart'])) {
    // Set cart item properties from the form data
    $cart_id = $_POST['cart_id'];
    $jumlah = $_POST['jumlah'];

    // Attempt to update item in cart
    $keranjang->updateCartItem($cart_id, $jumlah);
}

// Check if the remove from cart form is submitted
if (isset($_POST['remove_from_cart'])) {
    // Set cart item ID from the form data
    $cart_id = $_POST['cart_id'];

    // Attempt to remove item from cart
    $keranjang->removeFromCart($cart_id);
}

// Get all items in the cart
$user_id = 1; // Assuming user ID is 1 for demonstration purpose
$cart_items = $keranjang->getUserCart($user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
</head>

<body>

    <h1>Shopping Cart</h1>

    <!-- Cart Items -->
    <h2>Cart Items</h2>
    <?php if (!empty($cart_items)) : ?>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cart_items as $item) : ?>
                <tr>
                    <td><?php echo $item['ker_id_produk']; ?></td>
                    <td><?php echo $item['ker_harga']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $item['ker_id']; ?>">
                            <input type="number" name="jumlah" value="<?php echo $item['ker_jml']; ?>">
                            <input type="submit" name="update_cart" value="Update">
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $item['ker_id']; ?>">
                            <input type="submit" name="remove_from_cart" value="Remove">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No items in cart.</p>
    <?php endif; ?>

    <!-- Add to Cart Form -->
    <h2>Add to Cart</h2>
    <form method="post">
        <input type="hidden" name="user_id" value="1"> <!-- Assuming user ID is 1 for demonstration purpose -->
        <label>Product ID:</label><br>
        <input type="text" name="produk_id" required><br>
        <label>Price:</label><br>
        <input type="text" name="harga" required><br>
        <label>Quantity:</label><br>
        <input type="number" name="jumlah" required><br>
        <input type="submit" name="add_to_cart" value="Add to Cart">
    </form>

    <ul>
        <li><a href="index.php">Back</a></li>
    </ul>

</body>

</html>
