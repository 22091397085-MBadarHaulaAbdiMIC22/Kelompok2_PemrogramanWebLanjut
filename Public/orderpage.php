<?php
// Include database and order class
include_once '../classes/Databases.php';
include_once '../classes/tb_order.php'; // Include the Order class

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize order object
$order = new Order($db); // Instantiate the Order class

// Check if the create order form is submitted
if (isset($_POST['create_order'])) { // Assuming this is the form for creating orders
    // Set order properties from the form data
    $order_id_user = $_POST['order_id_user'];
    $order_tgl = $_POST['order_tgl'];
    $order_kode = $_POST['order_kode'];
    $order_ttl = $_POST['order_ttl'];
    $order_ongkir = $_POST['order_ongkir'];
    $order_byr_deadline = $_POST['order_byr_deadline'];
    $updated_at = date('Y-m-d H:i:s');

    // Attempt to create the order
    if ($order->insertOrder($order_id_user, $order_tgl, $order_kode, $order_ttl, $order_ongkir, $order_byr_deadline, $updated_at)) {
        echo "<div>Order created successfully.</div>";
    } else {
        echo "<div>Unable to create order.</div>";
    }
}

// Check if the update order form is submitted
if (isset($_POST['update_order'])) { // Assuming this is the form for updating orders
    // Set order properties from the form data
    $order_id = $_POST['order_id'];
    $order_id_user = $_POST['order_id_user'];
    $order_tgl = $_POST['order_tgl'];
    $order_kode = $_POST['order_kode'];
    $order_ttl = $_POST['order_ttl'];
    $order_ongkir = $_POST['order_ongkir'];
    $order_byr_deadline = $_POST['order_byr_deadline'];
    $updated_at = date('Y-m-d H:i:s');

    // Attempt to update the order
    if ($order->updateOrder($order_id, $order_id_user, $order_tgl, $order_kode, $order_ttl, $order_ongkir, $order_byr_deadline, $updated_at)) {
        echo "<div>Order updated successfully.</div>";
    } else {
        echo "<div>Unable to update order.</div>";
    }
}

// Check if the delete order form is submitted
if (isset($_POST['delete_order'])) { // Assuming this is the form for deleting orders
    // Set order ID from the form data
    $order_id = $_POST['order_id'];

    // Attempt to delete the order
    if ($order->deleteOrder($order_id)) {
        echo "<div>Order deleted successfully.</div>";
    } else {
        echo "<div>Unable to delete order.</div>";
    }
}

// Get all orders
$orders = $order->getAllOrders();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
</head>

<body>

    <h1>Order Management</h1>

    <!-- Order Creation Form -->
    <h2>Create Order</h2>
    <form method="post">
        <label>User ID:</label><br>
        <input type="text" name="order_id_user" required><br>
        <label>Date:</label><br>
        <input type="date" name="order_tgl" required><br>
        <label>Order Code:</label><br>
        <input type="text" name="order_kode" required><br>
        <label>Total:</label><br>
        <input type="text" name="order_ttl" required><br>
        <label>Shipping Cost:</label><br>
        <input type="text" name="order_ongkir" required><br>
        <label>Payment Deadline:</label><br>
        <input type="date" name="order_byr_deadline" required><br>
        <input type="submit" name="create_order" value="Create Order">
    </form>

    <!-- Order List -->
    <h2>Order List</h2>
    <?php if (!empty($orders)) : ?>
        <ul>
            <?php foreach ($orders as $order) : ?>
                <li><?php echo $order['order_kode']; ?> - <?php echo $order['order_ttl']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No orders found.</p>
    <?php endif; ?>

    <!-- Order Update Form -->
    <h2>Update Order</h2>
    <form method="post">
        <label>Order ID:</label><br>
        <input type="text" name="order_id" required><br>
        <!-- Other fields for updating an order -->
        <input type="submit" name="update_order" value="Update Order">
    </form>

    <!-- Order Deletion Form -->
    <h2>Delete Order</h2>
    <form method="post">
        <label>Order ID:</label><br>
        <input type="text" name="order_id" required><br>
        <input type="submit" name="delete_order" value="Delete Order">
    </form>

    <ul>
        <li><a href="index.php">Back</a></li>
    </ul>

</body>

</html>
