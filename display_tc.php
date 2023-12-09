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

// Fetch articles from the "TECH EXPLORATION" category
$sql = "SELECT id, title, content, author, date, category FROM articles WHERE category = 'TECH EXPLORATION' ORDER BY date DESC";
$result = $conn->query($sql);

// Display articles
if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='article'>";
        echo "<h2>" . $row['title'] . "</h2>";

        // Display date and time
        echo "<p>Posted on: " . date("F j, Y, g:i a", strtotime($row['date'])) . "</p>";

        // Display full content
        echo "<p>" . $row['content'] . "</p>";

        echo "<p>Author: " . $row['author'] . "</p>";

        // Check if the user is logged in as an admin
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
            // Add Edit and Delete buttons only for admin
            echo "<div class 'article-buttons'>";
            echo "<a href='edit_article.php?id=" . $row['id'] . "'>Edit</a>";
            echo "<a href='delete_article.php?id=" . $row['id'] . "'>Delete</a>";
            echo "</div>";
        }

        // Add comments section (replace with your actual commenting system)
        echo "<div class 'comments-section'>";
        echo "<h3>Comments</h3>";
        // Display comments here (if applicable)
        echo "</div>";

        echo "</div>";
    }
} else {
    echo "No articles found in the 'TECH EXPLORATION' category.";
}

// Close the database connection
$conn->close();
?>

<style>
body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Style for the articles */
        .article {
            background-color: #fff;
            margin: 100px;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .article h2 {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }

        .article p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .article-buttons a {
            text-decoration: none;
            margin-right: 10px;
        }

        .article-buttons a:hover {
            color: #007bff;
        }

        .sharing-options a {
            text-decoration: none;
            margin-right: 10px;
        }

        .comments-section {
            margin-top: 20px;
        }
        articles {
       text-align: center;

        }
        .articles-container {
    text-align: center;
        }
    </style>




