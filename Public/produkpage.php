<?php
// Include database and product class
include_once '../classes/Databases.php';
include_once '../classes/tb_produk.php.'; // Include the Produk class

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize product object
$produk = new Produk($db); // Instantiate the Produk class

// Check if the add product form is submitted
if (isset($_POST['add_product'])) { // Changed from 'add_to_cart' to 'add_product'
    // Set product properties from the form data
    $produk_id_kat = $_POST['produk_id_kat'];
    $produk_id_user = $_POST['produk_id_user'];
    $produk_kode = $_POST['produk_kode'];
    $produk_nama = $_POST['produk_nama'];
    $produk_hrg = $_POST['produk_hrg'];
    $produk_keterangan = $_POST['produk_keterangan'];
    $produk_stock = $_POST['produk_stock'];
    $produk_photo = $_POST['produk_photo'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Attempt to add product
    $produk->insertProduk($produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $created_at, $updated_at);
}

// Check if the update product form is submitted
if (isset($_POST['update_product'])) { // Changed from 'update_cart' to 'update_product'
    // Set product properties from the form data
    $produk_id = $_POST['produk_id'];
    $produk_id_kat = $_POST['produk_id_kat'];
    $produk_id_user = $_POST['produk_id_user'];
    $produk_kode = $_POST['produk_kode'];
    $produk_nama = $_POST['produk_nama'];
    $produk_hrg = $_POST['produk_hrg'];
    $produk_keterangan = $_POST['produk_keterangan'];
    $produk_stock = $_POST['produk_stock'];
    $produk_photo = $_POST['produk_photo'];
    $updated_at = date('Y-m-d H:i:s');

    // Attempt to update product
    $produk->updateProduk($produk_id, $produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $updated_at);
}

// Check if the delete product form is submitted
if (isset($_POST['delete_product'])) { // Changed from 'remove_from_cart' to 'delete_product'
    // Set product ID from the form data
    $produk_id = $_POST['produk_id']; // Changed from 'cart_id' to 'produk_id'

    // Attempt to delete product
    $produk->deleteProduk($produk_id);
}

// Get all products
$all_products = $produk->getAllProduk(); // Changed from 'cart_items' to 'all_products'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
</head>

<body>

    <h1>Product Management</h1>

    <!-- Product Creation Form -->
    <h2>Create Product</h2>
    <form method="post">
        <label>Category ID:</label><br>
        <input type="text" name="produk_id_kat" required><br>
        <label>User ID:</label><br>
        <input type="text" name="produk_id_user" required><br>
        <label>Product Code:</label><br>
        <input type="text" name="produk_kode" required><br>
        <label>Name:</label><br>
        <input type="text" name="produk_nama" required><br>
        <label>Price:</label><br>
        <input type="text" name="produk_hrg" required><br>
        <label>Description:</label><br>
        <textarea name="produk_keterangan" required></textarea><br>
        <label>Stock:</label><br>
        <input type="text" name="produk_stock" required><br>
        <label>Photo:</label><br>
        <input type="text" name="produk_photo" required><br>
        <input type="submit" name="add_product" value="Add Product">
    </form>

    <!-- Product List -->
    <h2>Product List</h2>
    <?php if (!empty($all_products)) : ?>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php foreach ($all_products as $product) : ?>
                <tr>
                    <td><?php echo $product['produk_id']; ?></td>
                    <td><?php echo $product['produk_nama']; ?></td>
                    <td><?php echo $product['produk_hrg']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="produk_id" value="<?php echo $product['produk_id']; ?>">
                            <input type="submit" name="delete_product" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No products found.</p>
    <?php endif; ?>

    <ul>
        <li><a href="index.php">Back</a></li>
    </ul>

</body>

</html>
