<?php
// Include database and users class
include_once '../classes/Databases.php';
include_once '../classes/tb_users.php'; // Include the Users class

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize users object
$users = new Users($db); // Instantiate the Users class

// Check if the create user form is submitted
if (isset($_POST['create_user'])) { // Changed from 'create_category' to 'create_user'
    // Set user properties from the form data
    $user_email = $_POST['user_email']; // Changed from 'kat_nama' to 'user_email'
    $user_password = $_POST['user_password']; // Added password field
    $user_nama = $_POST['user_nama']; // Added name field
    $user_alamat = $_POST['user_alamat']; // Added address field
    $user_hp = $_POST['user_hp']; // Added phone field
    $user_pos = $_POST['user_pos']; // Added position field
    $user_role = $_POST['user_role']; // Added role field
    $user_aktif = $_POST['user_aktif']; // Added active field
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Attempt to create the user
    if ($users->insertUser($user_email, $user_password, $user_nama, $user_alamat, $user_hp, $user_pos, $user_role, $user_aktif, $created_at, $updated_at)) {
        echo "<div>User created successfully.</div>";
    } else {
        echo "<div>Unable to create user.</div>";
    }
}

// Check if the update user form is submitted
if (isset($_POST['update_user'])) { // Changed from 'update_category' to 'update_user'
    // Set user properties from the form data
    $user_id = $_POST['user_id']; // Changed from 'kat_id' to 'user_id'
    $user_email = $_POST['user_email']; // Changed from 'kat_nama' to 'user_email'
    $user_password = $_POST['user_password']; // Added password field
    $user_nama = $_POST['user_nama']; // Added name field
    $user_alamat = $_POST['user_alamat']; // Added address field
    $user_hp = $_POST['user_hp']; // Added phone field
    $user_pos = $_POST['user_pos']; // Added position field
    $user_role = $_POST['user_role']; // Added role field
    $user_aktif = $_POST['user_aktif']; // Added active field
    $updated_at = date('Y-m-d H:i:s');

    // Attempt to update the user
    if ($users->updateUser($user_id, $user_email, $user_password, $user_nama, $user_alamat, $user_hp, $user_pos, $user_role, $user_aktif, $updated_at)) {
        echo "<div>User updated successfully.</div>";
    } else {
        echo "<div>Unable to update user.</div>";
    }
}

// Check if the delete user form is submitted
if (isset($_POST['delete_user'])) { // Changed from 'delete_category' to 'delete_user'
    // Set user ID from the form data
    $user_id = $_POST['user_id']; // Changed from 'kat_id' to 'user_id'

    // Attempt to delete the user
    if ($users->deleteUser($user_id)) {
        echo "<div>User deleted successfully.</div>";
    } else {
        echo "<div>Unable to delete user.</div>";
    }
}

// Get all users
$all_users = $users->getAllUsers(); // Changed from 'categories' to 'all_users'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
</head>

<body>

    <h1>User Management</h1>

    <!-- User Creation Form -->
    <h2>Create User</h2>
    <form method="post">
        <label>Email:</label><br> <!-- Changed from 'Name' to 'Email' -->
        <input type="text" name="user_email" required><br> <!-- Changed from 'kat_nama' to 'user_email' -->
        <label>Password:</label><br> <!-- Added password field -->
        <input type="password" name="user_password" required><br> <!-- Added password field -->
        <label>Name:</label><br> <!-- Added name field -->
        <input type="text" name="user_nama" required><br> <!-- Added name field -->
        <label>Address:</label><br> <!-- Added address field -->
        <input type="text" name="user_alamat" required><br> <!-- Added address field -->
        <label>Phone:</label><br> <!-- Added phone field -->
        <input type="text" name="user_hp" required><br> <!-- Added phone field -->
        <label>Position:</label><br> <!-- Added position field -->
        <input type="text" name="user_pos" required><br> <!-- Added position field -->
        <label>Role:</label><br> <!-- Added role field -->
        <input type="text" name="user_role" required><br> <!-- Added role field -->
        <label>Active:</label><br> <!-- Added active field -->
        <input type="text" name="user_aktif" required><br> <!-- Added active field -->
        <input type="submit" name="create_user" value="Create User">
    </form>

    <!-- User List -->
    <h2>User List</h2>
    <?php if (!empty($all_users)) : ?> <!-- Changed from 'categories' to 'all_users' -->
        <ul>
            <?php foreach ($all_users as $user) : ?> <!-- Changed from 'categories' to 'all_users' -->
                <li><?php echo $user['user_email']; ?> - <?php echo $user['user_nama']; ?></li> <!-- Changed from 'kat_nama' to 'user_email' -->
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No users found.</p>
    <?php endif; ?>

    <!-- User Update Form -->
    <h2>Update User</h2>
    <form method="post">
        <label>User ID:</label><br>
        <input type="text" name="user_id" required><br>
        <label>Email:</label><br>
        <input type="text" name="user_email" required><br>
        <label>Password:</label><br>
        <input type="password" name="user_password" required><br>
        <label>Name:</label><br>
        <input type="text" name="user_nama" required><br>
        <label>Address:</label><br>
        <input type="text" name="user_alamat" required><br>
        <label>Phone:</label><br>
        <input type="text" name="user_hp" required><br>
        <label>Position:</label><br>
        <input type="text" name="user_pos" required><br>
        <label>Role:</label><br>
        <input type="text" name="user_role" required><br>
        <label>Active:</label><br>
        <input type="text" name="user_aktif" required><br>
        <input type="submit" name="update_user" value="Update User">
    </form>

    <!-- User Deletion Form -->
    <h2>Delete User</h2>
    <form method="post">
        <label>User ID:</label><br>
        <input type="text" name="user_id" required><br>
        <input type="submit" name="delete_user" value="Delete User">
    </form>

</body>

</html>
        
