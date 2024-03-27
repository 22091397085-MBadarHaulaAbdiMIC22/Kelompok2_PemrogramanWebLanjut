<?php
// Include database and category class
include_once '../classes/Databases.php';
include_once '../classes/tb_kategori.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize category object
$kategori = new Kategori($db);

// Check if the create category form is submitted
if (isset($_POST['create_category'])) {
    // Set category properties from the form data
    $kat_nama = $_POST['kat_nama'];
    $kat_keterangan = $_POST['kat_keterangan'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Attempt to create the category
    if ($kategori->insertKategori($kat_nama, $kat_keterangan, $created_at, $updated_at)) {
        echo "<div>Category created successfully.</div>";
    } else {
        echo "<div>Unable to create category.</div>";
    }
}

// Check if the update category form is submitted
if (isset($_POST['update_category'])) {
    // Set category properties from the form data
    $kat_id = $_POST['kat_id'];
    $kat_nama = $_POST['kat_nama'];
    $kat_keterangan = $_POST['kat_keterangan'];
    $updated_at = date('Y-m-d H:i:s');

    // Attempt to update the category
    if ($kategori->updateKategori($kat_id, $kat_nama, $kat_keterangan, $updated_at)) {
        echo "<div>Category updated successfully.</div>";
    } else {
        echo "<div>Unable to update category.</div>";
    }
}

// Check if the delete category form is submitted
if (isset($_POST['delete_category'])) {
    // Set category ID from the form data
    $kat_id = $_POST['kat_id'];

    // Attempt to delete the category
    if ($kategori->deleteKategori($kat_id)) {
        echo "<div>Category deleted successfully.</div>";
    } else {
        echo "<div>Unable to delete category.</div>";
    }
}

// Get all categories
$categories = $kategori->getAllKategori();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>
</head>

<body>

    <h1>Category Management</h1>

    <!-- Category Creation Form -->
    <h2>Create Category</h2>
    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="kat_nama" required><br>
        <label>Description:</label><br>
        <textarea name="kat_keterangan" required></textarea><br>
        <input type="submit" name="create_category" value="Create Category">
    </form>

    <!-- Category List -->
    <h2>Category List</h2>
    <?php if (!empty($categories)) : ?>
        <ul>
            <?php foreach ($categories as $category) : ?>
                <li><?php echo $category['kat_nama']; ?> - <?php echo $category['kat_keterangan']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No categories found.</p>
    <?php endif; ?>

    <!-- Category Update Form -->
    <h2>Update Category</h2>
    <form method="post">
        <label>Category ID:</label><br>
        <input type="text" name="kat_id" required><br>
        <label>Name:</label><br>
        <input type="text" name="kat_nama" required><br>
        <label>Description:</label><br>
        <textarea name="kat_keterangan" required></textarea><br>
        <input type="submit" name="update_category" value="Update Category">
    </form>

    <!-- Category Deletion Form -->
    <h2>Delete Category</h2>
    <form method="post">
        <label>Category ID:</label><br>
        <input type="text" name="kat_id" required><br>
        <input type="submit" name="delete_category" value="Delete Category">
    </form>

    <ul>
        <li><a href="index.php">Back</a></li>
    </ul>

</body>

</html>
