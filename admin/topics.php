<?php
include_once '../includes/admin_check.php';
require_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

$error = $success = '';

// Add topic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_topic'])) {
        $subject_id = $_POST['subject_id'];
        $topic_name = trim($_POST['topic_name']);

        if ($subject_id && $topic_name) {
            mysqli_query($conn, "INSERT INTO topics (subject_id, name) VALUES ('$subject_id', '$topic_name')");
            $success = 'Topic added!';
        } else {
            $error = 'All fields required.';
        }
    } elseif (isset($_POST['edit_topic'])) {
        $id = $_POST['topic_id'];
        $newname = trim($_POST['topic_name']);
        if ($newname) {
            mysqli_query($conn, "UPDATE topics SET name='$newname' WHERE id=$id");
            $success = 'Topic updated!';
        } else {
            $error = 'Invalid edit input.';
        }
    }
    header("Location: topics.php");
    exit();
}

// Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM topics WHERE id=$id");
    header("Location: topics.php");
    exit();
}

// Fetch subjects and topics
$subjects = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM subjects"), MYSQLI_ASSOC);
$topics = mysqli_fetch_all(mysqli_query($conn, "
    SELECT t.id, t.name, s.name AS subject_name
    FROM topics t
    JOIN subjects s ON t.subject_id = s.id
    ORDER BY t.id
"), MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Topics</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="page-wrapper">
<header>
    <div class="logo">Admin Panel</div>
    <nav><a href="dashboard.php">Dashboard</a> <a href="../auth/logout.php">Logout</a></nav>
</header>

<div class="dashboard-container">
    <div class="sidebar">
        <ul>
            <li><a href="streams.php">Streams</a></li>
            <li><a href="subjects.php">Subjects</a></li>
            <li><a href="topics.php" class="active">Topics</a></li>
            <li><a href="topic_details.php">Topic Details</a></li>
        </ul>
    </div>

    <div class="main-content">
            <!-- Add Topic -->
            <div class="description-box">
                <h2>Add Topic</h2>
                <form method="POST">
                    <input type="hidden" name="add_topic">
                    <label>Subject</label>
                    <select name="subject_id" required>
                        <option value="">--Select Subject--</option>
                        <?php foreach ($subjects as $s): ?>
                        <option value="<?= $s['id']; ?>"><?= htmlspecialchars($s['name']); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Topic Name</label>
                    <input type="text" name="topic_name" required>

                    <?php if ($error): ?><div class="error"><?= $error; ?></div><?php endif; ?>
                    <?php if ($success): ?><div class="success"><?= $success; ?></div><?php endif; ?>

                    <button type="submit">Add Topic</button>
                </form>

            <!-- List Topics -->
                <h2>Topics List</h2>
                <table>
                    <thead>
                        <tr><th>ID</th><th>Subject</th><th>Topic</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                    <?php foreach ($topics as $t): ?>
                        <tr>
                            <td><?= $t['id']; ?></td>
                            <td><?= htmlspecialchars($t['subject_name']); ?></td>
                            <td>
                                <span id="name-<?= $t['id']; ?>"><?= htmlspecialchars($t['name']); ?></span>
                                <form id="form-<?= $t['id']; ?>" method="POST" style="display:none;">
                                    <input type="hidden" name="edit_topic">
                                    <input type="hidden" name="topic_id" value="<?= $t['id']; ?>">
                                    <input type="text" name="topic_name" value="<?= htmlspecialchars($t['name']); ?>" required>
                                    <button type="submit">Save</button>
                                    <button type="button" onclick="toggleEdit(<?= $t['id']; ?>)">Cancel</button>
                                </form>
                            </td>
                            <td>
                                <button onclick="toggleEdit(<?= $t['id']; ?>)" class="btn">Edit</button>
                                <a href="?delete=<?= $t['id']; ?>" onclick="return confirm('Delete topic?')" class="btn">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>

<footer>&copy; <?= date("Y"); ?> eLearning Portal</footer>
</div>

<script>
function toggleEdit(id) {
    const span = document.getElementById('name-' + id);
    const form = document.getElementById('form-' + id);
    span.style.display = span.style.display === 'none' ? 'inline' : 'none';
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
</body>
</html>
