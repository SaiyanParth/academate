<link rel="stylesheet" href="assets/style.css">
<?php
require_once '../includes/auth_check.php';
require_once '../includes/header.php';
require_once '../includes/db.php';

// Get selected stream_id from POST
if (!isset($_POST['stream_id'])) {
    echo "<p>Stream not selected.</p>";
    include '../includes/footer.php';
    exit;
}

$stream_id = intval($_POST['stream_id']);

// Get stream name (optional, for heading)
$stream_name = '';
$stream_query = "SELECT name FROM streams WHERE id = $stream_id LIMIT 1";
$stream_result = mysqli_query($conn, $stream_query);
if ($stream_result && mysqli_num_rows($stream_result) > 0) {
    $row = mysqli_fetch_assoc($stream_result);
    $stream_name = $row['name'];
}

// Fetch distinct semesters from the subjects table for this stream
$semesters = [];
$sem_query = "SELECT DISTINCT semester FROM subjects WHERE stream_id = $stream_id ORDER BY semester ASC";
$sem_result = mysqli_query($conn, $sem_query);

if ($sem_result && mysqli_num_rows($sem_result) > 0) {
    while ($row = mysqli_fetch_assoc($sem_result)) {
        $semesters[] = $row['semester'];
    }
}
?>

<div class="container">
    <h2>Select a Semester<?php if ($stream_name) echo " for " . htmlspecialchars($stream_name); ?></h2>
    
    <?php if (empty($semesters)): ?>
        <p>No semesters found for this stream.</p>
    <?php else: ?>
        <form method="POST" action="subjects.php">
            <label for="semester">Choose a Semester:</label>
            <select name="semester" id="semester" required>
                <?php foreach ($semesters as $semester): ?>
                    <option value="<?php echo $semester; ?>">Semester <?php echo $semester; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="stream_id" value="<?php echo $stream_id; ?>">
            <button type="submit">Go to Subjects</button>
        </form>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
