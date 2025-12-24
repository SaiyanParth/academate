<?php
include_once '../includes/admin_check.php';
require_once '../includes/db.php';

// Handle Add Stream
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stream'])) {
    $name = trim($_POST['stream_name']);
    $university = trim($_POST['university']);
    if (!empty($name) && !empty($university)) {
        mysqli_query($conn, "INSERT INTO streams (name, university) VALUES ('$name', '$university')");
    }
    header("Location: streams.php");
    exit();
}

// Handle Edit Stream
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_stream'])) {
    $id = $_POST['stream_id'];
    $name = trim($_POST['stream_name']);
    $university = trim($_POST['university']);
    if (!empty($name) && !empty($university)) {
        mysqli_query($conn, "UPDATE streams SET name='$name', university='$university' WHERE id=$id");
    }
    header("Location: streams.php");
    exit();
}

// Handle Delete Stream
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM streams WHERE id=$id");
    header("Location: streams.php");
    exit();
}

// Fetch All Streams
$result = mysqli_query($conn, "SELECT * FROM streams ORDER BY id ASC");
$streams = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Streams</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<header>
    <div class="logo">Admin Panel</div>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>
</header>

<div class="dashboard-container">
    <div class="sidebar">
        <ul>
            <li><a class="active" href="streams.php">Stream</a></li>
            <li><a href="subjects.php">Subjects</a></li>
            <li><a href="topics.php">Topics</a></li>
            <li><a href="topic_details.php">Topic Details</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="description-box">
            <div class="container">
                <h2>Manage Streams</h2>

                <!-- Add New Stream Form -->
                <form method="POST">
                    <label for="stream_name">Stream Name:</label>
                    <input type="text" name="stream_name" id="stream_name" required>

                    <label for="university">University:</label>
                    <input type="text" name="university" id="university" required>

                    <button type="submit" name="add_stream" class="btn">Add Stream</button>
                </form>

                <!-- Stream Table -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Stream Name</th>
                            <th>University</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($streams as $stream): ?>
                        <tr>
                            <td><?= $stream['id']; ?></td>
                            <td>
                                <span id="name-<?= $stream['id']; ?>"><?= htmlspecialchars($stream['name']); ?></span>
                                <form method="POST" id="nameform-<?= $stream['id']; ?>" style="display:none;">
                                    <input type="hidden" name="stream_id" value="<?= $stream['id']; ?>">
                                    <input type="text" name="stream_name" value="<?= htmlspecialchars($stream['name']); ?>" required>
                                </form>
                            </td>
                            <td>
                                <span id="univ-<?= $stream['id']; ?>"><?= htmlspecialchars($stream['university']); ?></span>
                                <form method="POST" id="univform-<?= $stream['id']; ?>" style="display:none;">
                                    <input type="text" name="university" value="<?= htmlspecialchars($stream['university']); ?>" required>
                                    <button type="submit" name="edit_stream" class="btn">Save</button>
                                    <button type="button" onclick="toggleEdit(<?= $stream['id']; ?>)" class="btn">Cancel</button>
                                </form>
                            </td>
                            <td>
                                <button onclick="toggleEdit(<?= $stream['id']; ?>)" class="btn">Edit</button>
                                <a href="?delete=<?= $stream['id']; ?>" onclick="return confirm('Delete this stream?')" class="btn">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<footer>
    &copy; <?= date("Y"); ?> eLearning Portal - Admin Panel
</footer>

<script>
function toggleEdit(id) {
    const nameSpan = document.getElementById('name-' + id);
    const univSpan = document.getElementById('univ-' + id);
    const nameform = document.getElementById('nameform-' + id);
    const univform = document.getElementById('univform-' + id);


    if (nameform.style.display === 'none') {
        nameform.style.display = 'block';
        nameSpan.style.display = 'none';
        univSpan.style.display = 'none';
    } else {
        nameform.style.display = 'none';
        nameSpan.style.display = 'inline';
        univSpan.style.display = 'inline';
    }
    if(univform.style.display === 'none'){
        univform.style.display = 'block';
        nameSpan.style.display = 'none';
        univSpan.style.display = 'none';
    } else {
        univform.style.display = 'none';
        nameSpan.style.display = 'inline';
        univSpan.style.display = 'inline';
    }   
}
</script>

</body>
</html>
