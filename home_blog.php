<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="front.css">
</head>
<body>
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

// Declare the function only if it doesn't exist
if (!function_exists('makeLinksClickableInText')) {
    function makeLinksClickableInText($text) {
        // Define a regular expression pattern to match URLs
        $pattern = '/(https?:\/\/\S+)/';
        
        // Replace URLs with clickable hyperlinks
        $textWithLinks = preg_replace($pattern, '<a href="$1" target="_blank">link</a>', $text);
        
        return $textWithLinks;
    }
}

$sql = "SELECT articles.id, articles.title, articles.content, articles.date_submitted, articles.category_id, multimedia_files.filename, multimedia_files.filetype, multimedia_files.filedata
        FROM articles
        LEFT JOIN multimedia_files ON articles.id = multimedia_files.article_id
        WHERE articles.category_id = (SELECT id FROM categories WHERE name = 'BLOG') 
        ORDER BY articles.date_submitted DESC";

$result = $conn->query($sql);

// Display articles
if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='article'>";
        echo "<h2>" . $row['title'] . "</h2>";

        // Display date and time
        echo "<p>Date Posted: " . date("F j, Y, g:i a", strtotime($row['date_submitted'])) . "</p>";

        // Remove author display

        // Display multimedia if available
        if (!empty($row['filename']) && !empty($row['filetype']) && !empty($row['filedata'])) {
            $multimediaData = $row['filedata'];
            $fileType = $row['filetype'];
            $fileExtension = pathinfo($row['filename'], PATHINFO_EXTENSION);

            if (strpos($fileType, 'image') !== false) {
                // Display image
                $imageData = base64_encode($multimediaData);
                $src = "data:$fileType;base64,$imageData";
                echo "<img src='$src' alt='Article Multimedia'>";
            } elseif (strpos($fileType, 'pdf') !== false) {
                // Display PDF file
                $src = "data:$fileType;base64," . base64_encode($multimediaData);
                echo "<a href='$src' target='_blank'>View PDF</a>";
            } elseif (strpos($fileType, 'video') !== false) {
                // Display video (e.g., video/mp4)
                $src = "data:$fileType;base64," . base64_encode($multimediaData);
                echo "<video controls>
                        <source src='$src' type='$fileType'>
                      Your browser does not support the video tag.
                      </video>";
            }
        }

        // Truncate and display the content
        $content = stripslashes($row['content']);
        $content = nl2br($content);
        $max_length = 50; // Maximum length before truncation
        if (strlen($content) > $max_length) {
            $truncated_content = substr($content, 0, $max_length);
            $remaining_content = substr($content, $max_length);
            echo "<p>" . makeLinksClickableInText($truncated_content) . "... <a href='full_article.php?id=" . $row['id'] . "'>Read More</a></p>";
        } else {
            echo "<p>" . makeLinksClickableInText($content) . "</p>";
        }

        // ... (continue with comments section and other code)

        echo "</div>";
    }
} else {
    echo "No Tech articles found.";
}

// Close the database connection
$conn->close();
?>

    
</body>
</html>