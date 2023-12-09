<!DOCTYPE html>
<html lang="en">
<head>
<style>
       
       body {
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    background-color: #f2f2f2; 
}


        .edit-form * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.multimedia-container {
    text-align: center;
}

.multimedia-container img,
.multimedia-container video {
    max-width: 100%;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.multimedia-container label {
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.multimedia-container input {
    margin-top: 2px;
    padding: 2px;
    border: 1px solid #ccc; /* Replace with your desired border color */
    border-radius: 0.25rem; /* Adjust border-radius as needed */
    display: block;
    margin-left: auto;
    margin-right: auto;
}

        /* Add your custom styles for the edit form */
        .edit-form {
    background-color: #fff;
    padding: 8px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border-radius: 0.375rem;
    margin-top: 8px;
    max-width: 64rem;
    margin-left: auto;
    margin-right: auto;
    min-height: 500px; /* Adjust the min-height as needed */
}

input[name='title'] {
    height: 40px; /* Adjust the height as needed */
    display: inline-block; /* Ensures height property works for inline elements */
    vertical-align: top; /* Aligns the label to the top of the input */
    background-color: #f0f0f0; 
}


        .edit-form label {
            display: block;
            margin-bottom: 2px;
        }

        .edit-form input[type="text"],
        .edit-form input[type="file"] {
            width: 100%;
            padding: 2px;
            border: 1px solid #ccc; /* Replace with your desired border color */
            border-radius: 0.25rem; /* Adjust border-radius as needed */
            margin-bottom: 4px;
        }

        .edit-form textarea {
            width: 100%;
            padding: 2px;
            border: 1px solid #ccc; /* Replace with your desired border color */
            border-radius: 0.25rem; /* Adjust border-radius as needed */
            margin-bottom: 4px;
            height: 500px;
        }

        .edit-form input[type="submit"] {
            background-color: #3490dc; /* Replace with your desired background color */
            color: #fff; /* Replace with your desired text color */
            padding: 4px 8px;
            border: none;
            border-radius: 0.25rem; /* Adjust border-radius as needed */
            cursor: pointer;
        }
        input[name='author'] {
    width: 20% !important; /* Adjust the width as needed */
    background-color: #f0f0f0; /* Replace with your desired background color */
    padding: 10px; /* Adjust padding as needed */
    height: 30px; /* Adjust the height as needed */
}


    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IGULT | </title>
    <!-- Add this in the head section of your HTML file -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">

</head>
<body>
    <header>
    </header>
    
    <main>
    <?php
    // Include the header at the beginning

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

    function displayExistingMultimedia($multimediaData, $fileType, $filename) {
        $data = base64_encode($multimediaData);
        $src = "data:$fileType;base64,$data";

        echo "<div class='multimedia-container'>"; // Custom CSS class for styling
        if (strpos($fileType, 'image') !== false) {
            echo "<img src='$src' alt='Article Multimedia' style='max-width: 100%;'>";
            echo "<label for='replace_image'>Replace Image:</label>";
            echo "<input type='file' name='replace_image' accept='image/*'>";
            echo "<input type='checkbox' name='delete_image' value='1'> Delete Existing Image<br>";
        } elseif (strpos($fileType, 'video') !== false) {
            echo "<video controls style='max-width: 100%;'><source src='$src' type='$fileType'>Your browser does not support the video tag.</video>";
            echo "<label for='replace_video'>Replace Video:</label>";
            echo "<input type='file' name='replace_video' accept='video/*'>";
            echo "<input type='checkbox' name='delete_video' value='1'> Delete Existing Video<br>";
        }
        echo "</div>";
    }

    function displayEditForm($article_id, $row) {
        // Function to remove backslashes from a string
        function removeBackslashes($input) {
            return str_replace('\\', '', $input);
        }
    
        // Displaying the form container with a custom CSS class for styling
        echo "<div class='edit-form'>";
    
        // Form for updating the article with enctype for handling file uploads
        echo "<form action='update_article.php?id=" . htmlspecialchars($article_id) . "' method='POST' enctype='multipart/form-data'>";
    
        // Input field for the article title
        echo "<label for='title'>Title:</label>";
        echo "<input type='text' name='title' value='" . removeBackslashes(str_replace('\r\n', '', str_replace('\\"', '"', htmlspecialchars($row['title'])))) . "' required>";
    
        // Textarea for the article content, handling line breaks and escaping characters
        $content = removeBackslashes(str_replace(["\r\n\r\n", "\n\n", '\r\n'], "", removeBackslashes(str_replace('\\"', '"', htmlspecialchars_decode($row['content'])))));

        // Encode HTML entities without converting newlines to <br> tags
        $content = htmlspecialchars($content);
        
        echo "<label for='content'>Content:</label>";
        echo "<textarea name='content' rows='8' style='width: 100%; border: 1px solid #ccc; border-radius: 0.25rem;' required>$content</textarea>";
        
        // Input field for the article author, handling character escaping
        $authorValue = isset($row['author']) ? removeBackslashes(str_replace('\\"', '"', htmlspecialchars($row['author']))) : "";
        echo "<label for='author'>Author:</label>";
        echo "<input type='text' name='author' value='$authorValue' required placeholder='Enter author name'>";
echo "<br>"; // Line break here
// Submit button for updating the article, styled with custom CSS
echo "<input type='submit' value='Update' style='background-color: #3490dc; color: #fff; padding: 4px 8px; border: none; border-radius: 0.25rem; cursor: pointer;'>";

    
        // Closing the form container
        echo "</form>";
    
        // Closing the div container
        echo "</div>";
    }
    
    

    if (isset($_GET['id'])) {
        $article_id = $_GET['id'];

        // Use a prepared statement to fetch the article and its multimedia
        $sql = "SELECT articles.*, multimedia_files.filename, multimedia_files.filetype, multimedia_files.filedata
                FROM articles
                LEFT JOIN multimedia_files ON articles.id = multimedia_files.article_id
                WHERE articles.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if ($row['filename'] && $row['filetype'] && $row['filedata']) {
                displayExistingMultimedia($row['filedata'], $row['filetype'], $row['filename']);
            }

            displayEditForm($article_id, $row);
        } else {
            echo "Article not found.";
        }

        $stmt->close();
    } else {
        echo "Invalid request.";
    }

    // Close the database connection
    $conn->close();
    ?>
    
<!-- Wrapping div for centering -->
<div style='text-align: center;'>
    <!-- Back button linking to admin_panel.php with inline CSS -->
    <a href='admin_panel.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #3490dc; color: #fff; text-decoration: none; border-radius: 5px;'>Back to Admin Panel</a>
</div>

</main>

</body>
</html>




