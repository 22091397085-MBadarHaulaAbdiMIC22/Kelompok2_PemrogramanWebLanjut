<?php
// Include database and order detail class
include_once '../classes/Databases.php';
include_once '../classes/tb_orderdetail.php'; // Include the OrderDetail class

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize order detail object
$orderDetail = new OrderDetail($db); // Instantiate the OrderDetail class

// Check if the create order detail form is submitted
if (isset($_POST['create_order_detail'])) { // Assuming this is the form for creating order details
    // Set order detail properties from the form data
    $detail_id_order = $_POST['detail_id_order'];
    $detail_id_produk = $_POST['detail_id_produk'];
    $detail_harga = $_POST['detail_harga'];
    $detail_jml = $_POST['detail_jml'];

    // Attempt to create the order detail
    $orderDetail->insertOrderDetail($detail_id_order, $detail_id_produk, $detail_harga, $detail_jml);
}

// Check if the update order detail form is submitted
if (isset($_POST['update_order_detail'])) { // Assuming this is the form for updating order details
    // Set order detail properties from the form data
    $detail_id_order = $_POST['detail_id_order'];
    $detail_id_produk = $_POST['detail_id_produk'];
    $detail_harga = $_POST['detail_harga'];
    $detail_jml = $_POST['detail_jml'];

    // Attempt to update the order detail
    $orderDetail->updateOrderDetail($detail_id_order, $detail_id_produk, $detail_harga, $detail_jml);
}

// Check if the delete order detail form is submitted
if (isset($_POST['delete_order_detail'])) { // Assuming this is the form for deleting order details
    // Set order detail properties from the form data
    $detail_id_order = $_POST['detail_id_order'];
    $detail_id_produk = $_POST['detail_id_produk'];

    // Attempt to delete the order detail
    $orderDetail->deleteOrderDetail($detail_id_order, $detail_id_produk);
}

// Get all order details
$orderDetails = $orderDetail->getAllOrderDetails();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail Page</title>
</head>

<body>

    <h1>Order Detail Management</h1>

    <!-- Order Detail Creation Form -->
    <h2>Create Order Detail</h2>
    <form method="post">
        <label>Order ID:</label><br>
        <input type="text" name="detail_id_order" required><br>
        <label>Product ID:</label><br>
        <input type="text" name="detail_id_produk" required><br>
        <label>Price:</label><br>
        <input type="text" name="detail_harga" required><br>
        <label>Quantity:</label><br>
        <input type="text" name="detail_jml" required><br>
        <input type="submit" name="create_order_detail" value="Create Order Detail">
    </form>

    <!-- Order Detail List -->
    <h2>Order Detail List</h2>
    <?php if (!empty($orderDetails)) : ?>
        <ul>
            <?php foreach ($orderDetails as $orderDetail) : ?>
                <li><?php echo $orderDetail['detail_id_order']; ?> - <?php echo $orderDetail['detail_id_produk']; ?> - <?php echo $orderDetail['detail_harga']; ?> - <?php echo $orderDetail['detail_jml']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No order details found.</p>
    <?php endif; ?>

    <!-- Order Detail Update Form -->
    <h2>Update Order Detail</h2>
    <form method="post">
        <label>Order ID:</label><br>
        <input type="text" name="detail_id_order" required><br>
        <label>Product ID:</label><br>
        <input type="text" name="detail_id_produk" required><br>
        <label>Price:</label><br>
        <input type="text" name="detail_harga" required><br>
        <label>Quantity:</label><br>
        <input type="text" name="detail_jml" required><br>
        <input type="submit" name="update_order_detail" value="Update Order Detail">
    </form>

    <!-- Order Detail Deletion Form -->
    <h2>Delete Order Detail</h2>
    <form method="post">
        <label>Order ID:</label><br>
        <input type="text" name="detail_id_order" required><br>
        <label>Product ID:</label><br>
        <input type="text" name="detail_id_produk" required><br>
        <input type="submit" name="delete_order_detail" value="Delete Order Detail">
    </form>

    <ul>
        <li><a href="index.php">Back</a></li>
    </ul>

</body>

</html>
