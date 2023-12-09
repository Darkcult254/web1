<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: 'Raleway', sans-serif;
        }
        h1, h2, h3 {
            font-size: 14px !important;
            
        }
        .container {
    max-width: 500px !important;
    

}
    </style>
    <link rel="stylesheet" href="admin_panel.css">
    <link rel="stylesheet" href="submit.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap">
</head>
<body>
    <div class="container">
        <h3 style="text-align: center;">Editor</h3>

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

// Fetch articles with category information from the database
$sql = "SELECT articles.id, articles.title, articles.author, articles.date_submitted, categories.name AS category_name
        FROM articles
        INNER JOIN categories ON articles.category_id = categories.id
        ORDER BY articles.date_submitted DESC";

$result = $conn->query($sql);

// Display article titles with author, date, and category
if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='article'>";
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>Author: " . $row['author'] . "</p>";
        echo "<p>Date: " . $row['date_submitted'] . "</p>";
        echo "<p>Category: " . $row['category_name'] . "</p>";

        // Add Edit and Delete buttons for admin (modify or remove this section based on your user roles)
        echo "<div class='article-buttons'>";
        echo "<a href='edit_article.php?id=" . $row['id'] . "'>Edit</a>";
        echo "<a href='delete_article.php?id=" . $row['id'] . "'>Delete</a>";
        echo "</div>";

        echo "</div>";
    }
} else {
    echo "No articles found.";
}

// Close the database connection
$conn->close();
?>
</div>
</body>
</html>
