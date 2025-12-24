<link rel="stylesheet" href="../assets/style.css">
<?php
require_once '../includes/auth_check.php';
require_once '../includes/header.php';
require_once '../includes/db.php';

$topic_id = $_GET['topic_id'] ?? null;

if (!$topic_id) {
    echo "<p>Topic not selected.</p>";
    include '../includes/footer.php';
    exit;
}

// Get topic name
$topic_data = null;
$topic_query = "SELECT name FROM topics WHERE id = $topic_id LIMIT 1";
$topic_result = mysqli_query($conn, $topic_query);
if ($topic_result && mysqli_num_rows($topic_result) > 0) {
    $topic_data = mysqli_fetch_assoc($topic_result);
}

// Get materials for this topic
$materials = null;
$material_query = "SELECT video, pdf, text FROM materials WHERE topic_id = $topic_id LIMIT 1";
$material_result = mysqli_query($conn, $material_query);
if ($material_result && mysqli_num_rows($material_result) > 0) {
    $materials = mysqli_fetch_assoc($material_result);
}
?>

<div class="container">
    <?php if ($topic_data): ?>
        <h2>Details for <?php echo htmlspecialchars($topic_data['name']); ?></h2>

        <h3>YouTube Video:</h3>
        <?php if (!empty($materials['video'])): ?>
            <a href="<?php echo htmlspecialchars($materials['video']); ?>" target="_blank">Watch on YouTube</a>
        <?php else: ?>
            <p>No video available.</p>
        <?php endif; ?>

        <h3>PDF Material:</h3>
        <?php if (!empty($materials['pdf'])): ?>
            <a href="<?php echo htmlspecialchars($materials['pdf']); ?>" target="_blank">Download PDF</a>
        <?php else: ?>
            <p>No PDF uploaded.</p>
        <?php endif; ?>

        <h3>Text Summary:</h3>
        <?php if (!empty($materials['text'])): ?>
            <p><?php echo nl2br(htmlspecialchars($materials['text'])); ?></p>
        <?php else: ?>
            <p>No text summary available.</p>
        <?php endif; ?>

    <?php else: ?>
        <p>Topic not found.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
