<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "igult_database";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Prepare a DELETE statement using a parameterized query
    $sql = "DELETE FROM articles WHERE id = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $article_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Article deleted successfully
            echo "Article deleted successfully.";
        } else {
            echo "Error deleting article: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

<script>
function confirmDelete(articleId) {
    var result = confirm("Are you sure you want to delete this article?");
    
    if (result) {
        window.location.href = "delete_article.php?id=" + articleId;
    } else {
        window.location.href = "admin_panel.php"; // Redirect back to the admin panel without deleting
    }
}

// Automatically redirect to the admin panel after deletion
setTimeout(function() {
    window.location.href = "admin_panel.php";
}, 1000); // Redirect after 1 second
</script>
