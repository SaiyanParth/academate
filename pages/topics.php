<link rel="stylesheet" href="../assets/style.css">
<?php
require_once '../includes/auth_check.php';
require_once '../includes/header.php';
require_once '../includes/db.php';

$subject_id = $_GET['subject_id'] ?? null;

if (!$subject_id) {
    echo "<p>Subject not selected.</p>";
    include '../includes/footer.php';
    exit;
}

// Get subject name
$subject_name = '';
$subject_query = "SELECT name FROM subjects WHERE id = $subject_id LIMIT 1";
$subject_result = mysqli_query($conn, $subject_query);
if ($subject_result && mysqli_num_rows($subject_result) > 0) {
    $subject_row = mysqli_fetch_assoc($subject_result);
    $subject_name = $subject_row['name'];
}

// Fetch topics for the subject
$topics = [];
$topic_query = "SELECT id, name FROM topics WHERE subject_id = $subject_id ORDER BY name ASC";
$topic_result = mysqli_query($conn, $topic_query);
if ($topic_result && mysqli_num_rows($topic_result) > 0) {
    while ($row = mysqli_fetch_assoc($topic_result)) {
        $topics[] = $row;
    }
}
?>

<div class="container">
    <h2>Topics for <?php echo htmlspecialchars($subject_name); ?></h2>

    <?php if (!empty($topics)): ?>
        <ul>
            <?php foreach ($topics as $topic): ?>
                <li>
                    <a href="topic_detail.php?topic_id=<?php echo $topic['id']; ?>">
                        <?php echo htmlspecialchars($topic['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No topics found for this subject.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
