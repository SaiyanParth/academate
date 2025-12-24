<?php
include('../includes/auth_check.php');
include('../includes/header.php');
?>

<div class="dashboard-container">
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
            <P style="align:justify;">
                Navigate to "Select Stream" to choose your academic stream and semester and Get Started.<br>
            </P>
            <button onclick="location.href='select_stream.php'" class="btn">Select Stream</button>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
