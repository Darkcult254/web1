<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "root"; // Use "root" as the username
$password = "";     // Leave the password empty
$dbname = "igult_database";

try {
    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form (sanitize and validate as needed)
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $date = date("Y-m-d"); // Current date
    $category_name = mysqli_real_escape_string($conn, $_POST['category']); // Selected category name

    $success = false; // Initialize the success variable
    $error_message = ''; // Initialize the error message

    // Check if an article is being submitted
    if (!empty($title) && !empty($content)) {
        // If author is empty, display an error and stop execution
        if (empty($author)) {
            $error_message = "Error: Author's name is required.";
        } else {
            // Lookup the category_id based on the selected category name
            $category_query = "SELECT id FROM categories WHERE name = '$category_name'";
            $category_result = $conn->query($category_query);

            if ($category_result && $category_result->num_rows > 0) {
                $category_data = $category_result->fetch_assoc();
                $category_id = $category_data['id'];

                // Insert article data
                $stmt = $conn->prepare("INSERT INTO articles (title, content, author, date_submitted, category_id) VALUES (?, ?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("ssisi", $title, $content, $author, $date, $category_id);
                    if ($stmt->execute()) {
                        $article_id = $stmt->insert_id; // Get the ID of the inserted article

                        // Handle multimedia file upload
                        if (!empty($_FILES['multimedia']['name'])) {
                            $file_name = $_FILES['multimedia']['name'];
                            $file_type = $_FILES['multimedia']['type'];
                            $file_data = file_get_contents($_FILES['multimedia']['tmp_name']);

                            // Check if the file type is allowed
                            if (in_array($file_type, array("image/jpeg", "image/png", "video/mp4", "video/webm"))) {
                                // Insert multimedia file data
                                $stmt = $conn->prepare("INSERT INTO multimedia_files (filename, filetype, filedata, article_id) VALUES (?, ?, ?, ?)");
                                if ($stmt) {
                                    $stmt->bind_param("sssi", $file_name, $file_type, $file_data, $article_id);
                                    if ($stmt->execute()) {
                                        $success = true;
                                    } else {
                                        $error_message = "Error inserting multimedia file data: " . $stmt->error;
                                    }
                                } else {
                                    $error_message = "Error preparing multimedia file statement: " . $conn->error;
                                }
                            } else {
                                $error_message = "Error: Unsupported file type. Please upload an image (JPEG or PNG) or a video (MP4 or WebM).";
                            }
                        } else {
                            // No multimedia file provided, set an error flag
                            $error_message = "Error: Multimedia file is required.";
                        }
                    } else {
                        $error_message = "Error inserting article data: " . $stmt->error;
                    }
                } else {
                    $error_message = "Error preparing article statement: " . $conn->error;
                }
            } else {
                $error_message = "Error: Invalid category.";
            }
        }
    } else {
        // Set an error flag if title or content is empty
        $error_message = "Error: Title and content are required.";
    }

    // Close the database connection
    $conn->close();

    if ($success) {
        echo "<div style='text-align: center; margin-top: 20px;'>
            <p style='background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; padding: 10px; display: inline-block;'>
                Article created successfully.
            </p>
          </div>";
          echo "<div style='text-align: center;'>
                    <a href='admin_panel.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #3490dc; color: #fff; text-decoration: none; border-radius: 5px;'>Back to Admin Panel</a>
                </div>";
    } elseif (!empty($error_message)) {
        echo "<p style='font-family: 'Raleway', sans-serif; text-align: center; color: red;'><strong>$error_message</strong></p>";
    }

    // Redirect to the admin panel after a delay using a relative URL
    $base_url = "admin_panel.php"; // Relative URL to the destination page
    echo "<script>
        setTimeout(function() {
            window.location.href = '{$base_url}';
        }, 4000); // Redirect after 4 seconds
    </script>";
} catch (Exception $e) {
    echo "<p style='font-family: Poppins; text-align: center; color: red;'><strong>Error: " . $e->getMessage() . "</strong></p>";
}
?>
