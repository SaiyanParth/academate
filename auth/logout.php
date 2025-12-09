<link rel="stylesheet" href="assets/style.css"><?php
session_start();
session_unset();
session_destroy();

header("Location: login.php");
exit;
?>
