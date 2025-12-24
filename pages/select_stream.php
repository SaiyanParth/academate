<link rel="stylesheet" href="assets/style.css">
<?php
require_once '../includes/auth_check.php'; // Ensure user is logged in
require_once '../includes/header.php';
require_once '../includes/db.php'; // DB connection

// Fetch all streams from the database
$streams = [];
$sql = "SELECT id, name, university FROM streams ORDER BY name ASC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $streams[] = $row;
    }
}
?>

<div class="container">
    <h2>Select a Stream</h2>
    
    <form method="POST" action="semesters.php">
        <label for="stream">Choose a Stream:</label>
        <select name="stream_id" id="stream" required>
            <?php foreach ($streams as $stream): ?>
                <option value="<?php echo $stream['id']; ?>">
                    <?php echo $stream['name'] . ' (' . $stream['university'] . ')'; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Go to Semesters</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
