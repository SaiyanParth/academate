<link rel="stylesheet" href="assets/style.css"><?php
$host = 'localhost'; // Change if necessary (e.g., '127.0.0.1')
$user = 'root'; // Default MySQL username
$pass = ''; // Default MySQL password (empty for XAMPP)
$db = 'academate'; // Your database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
