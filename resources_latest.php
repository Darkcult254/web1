<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "root"; // Use "root" as the username
$password = "";    // Leave the password empty
$dbname = "igult_database";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the 3 latest articles from the "RESOURCES" category
$sql = "SELECT id, title
        FROM articles
        WHERE category = 'RESOURCES'
        ORDER BY date DESC
        LIMIT 10";

$result = $conn->query($sql);

// Display latest article titles on the sidebar
if ($result !== false && $result->num_rows > 0) {
    echo "<div class='latest-articles-sidebar'>";
   // echo "<h3>Latest Articles</h3";

    while ($row = $result->fetch_assoc()) {
        echo "<div class='latest-article'>";
        echo "<h4>" . $row['title'] . "</h4>";

        // Add a "Read More" link
        echo "<p><a href='full_article.php?id=" . $row['id'] . "'>Read More</a></p>";
        echo "</div>";
    }

    echo "</div>";
} else {
    //echo "No latest articles found.";
}

// Close the database connection
$conn->close();
?>
