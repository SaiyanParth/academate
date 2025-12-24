<?php
// Determine the redirect link based on login and role
$logoHref = "../index.php"; // Default

if (isset($_SESSION['name'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        $logoHref = "/Academate/admin/dashboard.php";
    } else {
        $logoHref = "/Academate/pages/dashboard.php";
    }
}
?>
<link rel="stylesheet" href="/Academate/assets/style.css"> <!-- Link to CSS file -->

<header>
    <a href="<?php echo $logoHref; ?>" class="logo">Academate</a>
    <nav>
        <?php if (isset($_SESSION['name'])): ?>
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></span>
            <a href="/Academate/auth/logout.php">Logout</a>
        <?php else: ?>
            <a href="/Academate/auth/login.php">Login</a>
            <a href="/Academate/auth/register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
