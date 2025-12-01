<?php session_start(); ?>
<?php
// Determine the redirect link based on login and role
$logoHref = "/elearning_portal/index.php"; // Default

if (isset($_SESSION['name'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        $logoHref = "/elearning_portal/admin/dashboard.php";
    } else {
        $logoHref = "/elearning_portal/pages/dashboard.php";
    }
}
?>
<link rel="stylesheet" href="/elearning_portal/assets/style.css"> <!-- Link to CSS file -->

<header>
    <a href="<?php echo $logoHref; ?>" class="logo">Academate</a>
    <nav>
        <?php if (isset($_SESSION['name'])): ?>
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></span>
            <a href="/elearning_portal/auth/logout.php">Logout</a>
        <?php else: ?>
            <a href="/elearning_portal/auth/login.php">Login</a>
            <a href="/elearning_portal/auth/register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
