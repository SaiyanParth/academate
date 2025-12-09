<?php
session_start();
include('../includes/auth_check.php');
include('../includes/header.php');
?>

<div class="dashboard-container">
    <div class="sidebar">
        <ul>
            <li><a href="select_stream.php">Stream</a></li>
            <li><a href="select_stream.php">Semester</a></li>
            <li><a href="select_stream.php">Subject</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="description-box">
            <p>
                This eLearning portal allows students to select their academic stream, semester, and subjects to access structured study materials including notes, videos, summaries, and questions. Tailored for:
                <ul>
                    <li>BTech (Parul University, Vadodara)</li>
                    <li>Diploma (Parul University, Vadodara)</li>
                    <li>BCom (MSU, Vadodara)</li>
                    <li>CA Foundation (India)</li>
                </ul>
                It's a centralized platform designed to support academic success and easy access to course-related content.
            </p>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
