<?php
include_once '../includes/admin_check.php';
require_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Handle additions
$error = $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_subject'])) {
        $stream_id = $_POST['stream_id'];
        $subject_name = trim($_POST['subject_name']);
        $semester = (int)$_POST['semester'];
        if ($stream_id && $subject_name && $semester > 0) {
            mysqli_query($conn, "INSERT INTO subjects (stream_id,name,semester) VALUES ('$stream_id','$subject_name','$semester')");
            $success = 'Subject added!';
        } else {
            $error = 'Please fill all fields correctly.';
        }
    } elseif (isset($_POST['edit_subject'])) {
        $id = $_POST['subject_id'];
        $newname = trim($_POST['subject_name']);
        $newsem = (int)$_POST['semester'];
        if ($newname && $newsem > 0) {
            mysqli_query($conn,"UPDATE subjects SET name='$newname', semester=$newsem WHERE id=$id");
            $success = 'Subject updated!';
        } else {
            $error = 'Invalid input for edit.';
        }
    }
    header("Location: subjects.php");
    exit();
}

// Handle deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM subjects WHERE id=$id");
    header("Location: subjects.php");
    exit();
}

// Fetch streams and subjects
$streams = mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM streams"), MYSQLI_ASSOC);
$subjects = mysqli_fetch_all(mysqli_query($conn, "
    SELECT s.id, s.name, s.semester, st.name AS stream_name
    FROM subjects s
    JOIN streams st ON s.stream_id = st.id
    ORDER BY s.id ASC
"), MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Subjects</title>
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
            <li><a class="active" href="subjects.php">Subjects</a></li>
            <li><a href="topics.php">Topics</a></li>
            <li><a href="topic_details.php">Topic Details</a></li>
        </ul>
    </div>

    <div class="main-content">
            <!-- Left: Add Form -->
            <div class="description-box">
                <h2>Add Subject</h2>
                <form method="POST">
                    <input type="hidden" name="add_subject">
                    <label>Stream</label>
                    <select name="stream_id" required>
                        <option value="">--Select Stream--</option>
                        <?php foreach ($streams as $st): ?>
                        <option value="<?= $st['id']; ?>"><?= htmlspecialchars($st['name']); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Subject Name</label>
                    <input type="text" name="subject_name" required>

                    <label>Semester</label>
                    <input type="number" name="semester" min="1" required>

                    <?php if ($error): ?><div class="error"><?= $error; ?></div><?php endif; ?>
                    <?php if ($success): ?><div class="success"><?= $success; ?></div><?php endif; ?>

                    <br><button type="submit" style="margin-top: 10px; margin-bottom: 5px;">Add Subject</button>
                </form>
            

            <!-- Right: Table -->
            
                <h2>Subjects List</h2>
                <table>
                    <thead>
                        <tr><th>ID</th><th>Stream</th><th>Name</th><th>Semester</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                    <?php foreach ($subjects as $sub): ?>
                        <tr>
                            <td><?= $sub['id']; ?></td>
                            <td><?= htmlspecialchars($sub['stream_name']); ?></td>
                            <td>
                                <span id="name-<?= $sub['id']; ?>"><?= htmlspecialchars($sub['name']); ?></span>
                                <form id="form-<?= $sub['id']; ?>" method="POST" style="display:none;">
                                    <input type="hidden" name="edit_subject">
                                    <input type="hidden" name="subject_id" value="<?= $sub['id']; ?>">
                                    <input type="text" name="subject_name" value="<?= htmlspecialchars($sub['name']); ?>" required>
                                    <input type="number" name="semester" value="<?= $sub['semester']; ?>" min="1" required>
                                    <button type="submit">Save</button>
                                    <button type="button" onclick="toggleEdit(<?= $sub['id']; ?>)">Cancel</button>
                                </form>
                            </td>
                            <td><?= $sub['semester']; ?></td>
                            <td>
                                <button onclick="toggleEdit(<?= $sub['id']; ?>)"  class="btn">Edit</button>
                                <a href="?delete=<?= $sub['id']; ?>" onclick="return confirm('Delete subject?')" class="btn">Delete</a>
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
    const span = document.getElementById('name-'+id);
    const form = document.getElementById('form-'+id);
    span.style.display = span.style.display === 'none' ? 'inline' : 'none';
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
</body>
</html>
