<link rel="stylesheet" href="assets/style.css">
<?php include_once '../includes/admin_check.php'; ?>
<?php
require_once '../includes/db.php'; // DB connection
require_once '../includes/header.php'; // Include the header

// Check if already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Dummy login credentials (You should replace this with DB validation)
    $admin_username = 'admin';
    $admin_password = 'admin123';

    if ($username == $admin_username && $password == $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Invalid credentials!';
    }
}
?>

<div class="container">
    <h2>Admin Login</h2>
    <form method="POST" action="">
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <button type="submit">Login</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
