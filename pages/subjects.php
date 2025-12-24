<link rel="stylesheet" href="../assets/style.css">
<?php
require_once '../includes/auth_check.php';
require_once '../includes/header.php';
require_once '../includes/db.php';

$stream_id = $_POST['stream_id'] ?? null;
$semester = $_POST['semester'] ?? null;

if (!$stream_id || !$semester) {
    echo "<p>Invalid access. Stream or semester not selected.</p>";
    include '../includes/footer.php';
    exit;
}

// Get stream name for heading
$stream_name = '';
$stream_query = "SELECT name FROM streams WHERE id = $stream_id LIMIT 1";
$stream_result = mysqli_query($conn, $stream_query);
if ($stream_result && mysqli_num_rows($stream_result) > 0) {
    $stream_row = mysqli_fetch_assoc($stream_result);
    $stream_name = $stream_row['name'];
}

// Fetch subjects for this stream and semester
$subjects = [];
$subject_query = "SELECT id, name FROM subjects WHERE stream_id = $stream_id AND semester = $semester ORDER BY name ASC";
$subject_result = mysqli_query($conn, $subject_query);
if ($subject_result && mysqli_num_rows($subject_result) > 0) {
    while ($row = mysqli_fetch_assoc($subject_result)) {
        $subjects[] = $row;
    }
}
?>

<div class="container">
    <h2>Subjects for <?php echo htmlspecialchars($stream_name); ?> - Semester <?php echo htmlspecialchars($semester); ?></h2>

    <?php if (!empty($subjects)): ?>
        <ul>
            <?php foreach ($subjects as $subject): ?>
                <li>
                    <a href="topics.php?subject_id=<?php echo $subject['id']; ?>">
                        <?php echo htmlspecialchars($subject['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No subjects found for this semester.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
