<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "root"; // Use "root" as the username
$password = "";    // Leave the password empty
$dbname = "igult_database";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch articles from the "TERMS AND CONDITIONS" category
$sql = "SELECT articles.id, articles.title, articles.content, articles.author, articles.date_submitted, articles.category_id
        FROM articles
        WHERE articles.category_id = (SELECT id FROM categories WHERE name = 'TERMS AND CONDITIONS')
        ORDER BY articles.date_submitted DESC
        LIMIT 7";

$result = $conn->query($sql);

// Check for errors in the query
if ($result === false) {
    die("Query error: " . $conn->error);
}

// Display articles
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='article'>";
        echo "<h2>" . $row['title'] . "</h2>";

        // Display date and time
        echo "<p>Posted on: " . date("F j, Y, g:i a", strtotime($row['date_submitted'])) . "</p>";

        // Truncate content and add "Read More" link
        
        $content = stripslashes($row['content']);
        $content = nl2br($content);
        $max_length = 1000; // Maximum length before truncation
        if (strlen($content) > $max_length) {
            $truncated_content = substr($content, 0, $max_length);
            $remaining_content = substr($content, $max_length);
            echo "<p>" . $truncated_content . "... <a href='full_article.php?id=" . $row['id'] . "'>Read More</a></p>";
        } else {
            echo "<p>" . $content . "</p>";
        }

        echo "<p>Author: " . $row['author'] . "</p>";

        // Check if the user is logged in as an admin
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
            // Add Edit and Delete buttons only for admin
            echo "<div class 'article-buttons'>";
            echo "<a href='edit_article.php?id=" . $row['id'] . "'>Edit</a>";
            echo "<a href 'delete_article.php?id=" . $row['id'] . "'>Delete</a>";
            echo "</div>";
        }

        // Add comments section (replace with your actual commenting system)
        echo "<div class='comments-section'>";
        echo "<h3>Comments</h3>";
        // Display comments here (if applicable)
        echo "</div>";

        echo "</div>";
    }
} else {
    // echo "No articles found in the 'TERMS AND CONDITIONS' category.";
}

// Close the database connection
$conn->close();
?>
<style>
body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0px;
            padding: 0;
            max-width: 1200;
        }
.title {
    font-size: 16px;
}
.summary {
    font-weight: bold;
    text-align: center;
}

   
/* Style for the articles */
        .article {
            background-color: #fff;
            margin: 0px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .article h1 h2 h3 {
            font-size: 16px;
            margin-bottom: 0px;
            text-align: center;
            font-family: Poppins sans;
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




