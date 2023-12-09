<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "igult_database";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the comment_id is set
    if (isset($_POST["comment_id"])) {
        $comment_id = $_POST["comment_id"];

        // Perform the deletion
        $sqlDeleteComment = "DELETE FROM comments WHERE comment_id = ?";
        $stmtDeleteComment = $conn->prepare($sqlDeleteComment);
        $stmtDeleteComment->bind_param("i", $comment_id);

        if ($stmtDeleteComment->execute()) {
            // Deletion successful
            header("Location: your_article_page.php"); // Redirect back to the article page
            exit();
        } else {
            // Error handling
            echo "Error deleting comment: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
