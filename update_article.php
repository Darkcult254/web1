<?php
// Include the header at the beginning (if needed)

// Replace with your actual database credentials
$servername = "localhost";
$username = "root"; // Use "root" as the username
$password = "";    // Leave the password empty
$dbname = "igult_database";

// Connect to the database (replace with your database credentials)
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the article ID from the URL
    if (isset($_GET['id'])) {
        $article_id = $_GET['id'];

        // Get data from the form
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];

        // Use a prepared statement to update the article
        $sql = "UPDATE articles SET title = ?, content = ?, author = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Use htmlspecialchars to escape HTML tags and preserve structure
        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
        $author = htmlspecialchars($author, ENT_QUOTES, 'UTF-8');

        $stmt->bind_param("sssi", $title, $content, $author, $article_id);

        if ($stmt->execute()) {
            // Article updated successfully

            // Check if the user wants to replace or delete the existing multimedia files
            if (isset($_POST['replace_image']) && $_POST['replace_image'] == 1) {
                // Handle replacing the image - similar logic for videos
                if ($_FILES['replace_image']['size'] > 0) {
                    $newImageFilename = $_FILES['replace_image']['name'];
                    $newImageData = file_get_contents($_FILES['replace_image']['tmp_name']);

                    // Update multimedia_files table
                    $updateMediaSql = "UPDATE multimedia_files SET filename = ?, filetype = ?, filedata = ? WHERE article_id = ?";
                    $updateMediaStmt = $conn->prepare($updateMediaSql);
                    $updateMediaStmt->bind_param("sssi", $newImageFilename, $_FILES['replace_image']['type'], $newImageData, $article_id);

                    $updateMediaStmt->execute();
                    $updateMediaStmt->close();
                }
            } elseif (isset($_POST['delete_image']) && $_POST['delete_image'] == 1) {
                // Handle deleting the image - similar logic for videos
                $deleteMediaSql = "DELETE FROM multimedia_files WHERE article_id = ?";
                $deleteMediaStmt = $conn->prepare($deleteMediaSql);
                $deleteMediaStmt->bind_param("i", $article_id);

                $deleteMediaStmt->execute();
                $deleteMediaStmt->close();
            }

            echo "<div style='text-align: center; margin-top: 20px;'>
            <p style='background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; padding: 10px; display: inline-block;'>
                Article updated successfully.
            </p>
          </div>";

            // Display the back button after a successful update
            echo "<div style='text-align: center;'>
                    <a href='admin_panel.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #3490dc; color: #fff; text-decoration: none; border-radius: 5px;'>Back to Admin Panel</a>
                </div>";
        } else {
            echo "Error updating article: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid request.";
    }
} else {
    // Display the back button for GET requests
    echo "<div style='text-align: center;'>
    <!-- Back button linking to admin_panel.php with inline CSS -->
    <a href='admin_panel.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #3490dc; color: #fff; text-decoration: none; border-radius: 5px;'>Back to Admin Panel</a>
</div>";
}

$conn->close();
?>
