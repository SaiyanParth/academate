<?php
include_once '../includes/admin_check.php';
require_once '../includes/db.php';
require_once '../includes/header.php';

$topic_id = $_GET['topic_id'] ?? null;
$topic = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM topics WHERE id = '$topic_id'"));
$material = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM materials WHERE topic_id = '$topic_id'")) ?? ['video' => '', 'pdf' => '', 'text' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video = $_POST['video_url'];
    $pdf = $_POST['pdf_url'];
    $text = $_POST['text_content'];

    $exists = mysqli_query($conn, "SELECT topic_id FROM materials WHERE topic_id = '$topic_id'");
    if (mysqli_num_rows($exists)) {
        mysqli_query($conn, "UPDATE materials SET video = '$video', pdf = '$pdf', text = '$text' WHERE topic_id = '$topic_id'");
    } else {
        mysqli_query($conn, "INSERT INTO materials (topic_id, video, pdf, text) VALUES ('$topic_id', '$video', '$pdf', '$text')");
    }

    echo "<script>alert('Materials updated successfully!'); location.href='view_materials.php?topic_id=$topic_id';</script>";
}
?>

<link rel="stylesheet" href="../assets/style.css">

<div class="dashboard-container">
    <aside class="sidebar">
        <ul>
            <li><a href="streams.php">Stream</a></li>
            <li><a href="subjects.php">Subjects</a></li>
            <li><a href="topics.php">Topics</a></li>
            <li><a href="topic_details.php" class="active">Topic Details</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="description-box">
            <h2>Materials for: <?= htmlspecialchars($topic['name']) ?></h2>

            <form method="POST">
                <div class="form-group">
                    <label>Video URL:</label>
                    <input type="text" name="video_url" value="<?= htmlspecialchars($material['video']) ?>">
                </div>

                <div class="form-group">
                    <label>PDF URL:</label>
                    <input type="text" name="pdf_url" value="<?= htmlspecialchars($material['pdf']) ?>">
                    <p>
                        <?= $material['pdf'] 
                            ? "<a href='{$material['pdf']}' target='_blank'>Preview PDF</a>" 
                            : "No PDF available" ?>
                    </p>
                </div>

                <div class="form-group">
                    <label>Text Content:</label>
                    <textarea name="text_content"><?= htmlspecialchars($material['text']) ?></textarea>
                    <p>
                        <?= $material['text'] 
                            ? nl2br(htmlspecialchars($material['text'])) 
                            : "No text content available" ?>
                    </p>
                </div>

                <button type="submit">Save Materials</button>
                <a href="topic_details.php" class="btn">Back</a>
            </form>
        </div>
    </main>
</div>

<?php include '../includes/footer.php'; ?>
