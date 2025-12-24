<?php
include_once '../includes/admin_check.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
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
            <h2>Topic Details</h2>

            <!-- 🔍 Search Bar -->
            <input type="text" id="searchInput" placeholder="Search for a topic..." style="width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #444; background-color: #2a2a2a; color: #fff;">

            <table id="topicTable">
                <thead>
                    <tr>
                        <th>Topic Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $topics_result = mysqli_query($conn, "SELECT id, name FROM topics");
                    while ($topic = mysqli_fetch_assoc($topics_result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($topic['name']) . "</td>";
                        echo "<td><a href='view_materials.php?topic_id={$topic['id']}' class='btn'>View / Edit</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
// 🔍 Real-time search filter
document.getElementById("searchInput").addEventListener("keyup", function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll("#topicTable tbody tr");

    rows.forEach(row => {
        const topic = row.querySelector("td").textContent.toLowerCase();
        row.style.display = topic.includes(filter) ? "" : "none";
    });
});
</script>

<?php include '../includes/footer.php'; ?>
