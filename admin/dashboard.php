<link rel="stylesheet" href="../assets/style.css">
<?php include_once '../includes/admin_check.php'; ?>
<?php

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}
require_once '../includes/header.php';
?>

<div class="page-wrapper">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li><a href="streams.php">Streams</a></li>
                <li><a href="subjects.php">Subjects</a></li>
                <li><a href="topics.php">Topics</a></li>
                <li><a href="topic_details.php">Topic Details</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="description-box">
                <h2>Welcome to the Admin Dashboard</h2>
                <p>You can manage the following:</p>
                <ul>
                    <li>➤ Add / Edit / Delete Streams</li>
                    <li>➤ Manage Subjects by Semester</li>
                    <li>➤ Add Topics under Subjects</li>
                    <li>➤ Link materials (YouTube / Text / PDF) to topics</li>
                </ul>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</div>
</body>
</html>