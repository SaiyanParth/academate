<?php
// Start the session
session_start();

// Include the database connection file
include('../includes/db.php');

// Initialize error variable
$error = "";

if (isset($_POST['login'])) {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists in the database
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the password entered by the user
        if (password_verify($password, $user['password'])) {
            // Store user data in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['name'] = $user['name']; 
            $_SESSION['role'] = $user['role']; 
            
            if ($user['role'] === 'admin') {
               header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../pages/dashboard.php");
            }
            exit();  // Ensure no further code is executed
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <!-- Login Form -->
        <form action="login.php" method="POST">
            <!-- Display error message if any -->
            <?php if (!empty($error)): ?>
                <p style="color:red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <!-- Email input field -->
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <!-- Password input field -->
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <!-- Submit button -->
            <input type="submit" name="login" value="submit">
        </form>

        <!-- Register link for new users -->
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
