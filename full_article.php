<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <style>
        /* Style the first letter of the word "Summary" */
*:contains("Summary")::first-letter {
  color: blue; /* Your desired style for the first letter */
}

/* Style the hyphens */
*:contains("-") {
  color: red; /* Your desired style for hyphens */
}

        body {
  font-family: 'Raleway', sans-serif;
}
        .article-title {
    text-align: center;
    font-weight: bold;
}
    /* Add these styles for comments section */
    .comments-section {
        margin-top: 30px;
    }

    .comment {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .comment-author {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .comment-date {
        color: #888;
        font-size: 0.9em;
    }

    /* Add spacing for name and date in the article */
    .article-info,
    .article-author {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    /* Add styling for spacing and font in the article content */
    .article-content {
        line-height: 1.6;
        margin-top: 20px;
        margin-bottom: 20px;
        font-size: 16px;
        font-family: 'Raleway', sans-serif;
      

    }
    .comment {
    margin-bottom: 20px; /* Adjust this value to set the desired spacing between comments */
}
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IGULT</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-...your-sha512-here..." crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="blogs.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" />
</head>

<body>
<header>
<?php
include_once ('header.php');
?>
</header>
<hr style="border: 1px solid rgba(0, 0, 0, 0); border-top: 2px solid black; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.5); margin-top: 100px;">

<main class="container">
    <section class="blog-content">
        <!-- Latest Articles Section -->
        <div class="featured-articles-card">
            <div class="featured-articles-box">
                <ul class="article-list" id="article-list">
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

// Function to remove backslashes
function removeBackslashes($string)
{
    return stripslashes($string);
}

// Retrieve the article ID from the URL parameter
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT articles.id, articles.title, articles.content, articles.author, articles.date_submitted, articles.category_id, multimedia_files.filename, multimedia_files.filetype, multimedia_files.filedata
            FROM articles
            LEFT JOIN multimedia_files ON articles.id = multimedia_files.article_id
            WHERE articles.id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='article-title'>" . stripslashes($row['title']) . "</div>";
        echo "<div class='article-info'>Posted on: " . date("F j, Y, g:i a", strtotime($row['date_submitted'])) . "</div>";

        // Display author
        $author = !empty($row['author']) ? $row['author'] : 'Antipas Henry';
        echo "<p>Author: " . $author . "</p>";

        // Display multimedia if available
        if (!empty($row['filename']) && !empty($row['filetype']) && !empty($row['filedata'])) {
            $multimediaData = $row['filedata'];
            $fileType = $row['filetype'];

            if (strpos($fileType, 'image') !== false) {
                // Display image
                $imageData = base64_encode($multimediaData);
                $src = "data:$fileType;base64,$imageData";
                echo "<img src='$src' alt='Article Multimedia' class='article-multimedia'>";
            } elseif (strpos($fileType, 'pdf') !== false) {
                // Display PDF file
                $src = "data:$fileType;base64," . base64_encode($multimediaData);
                echo "<a href='$src' target='_blank' class='article-multimedia'>Download PDF</a>";
            } elseif (strpos($fileType, 'video') !== false) {
                // Display video (e.g., video/mp4)
                $src = "data:$fileType;base64," . base64_encode($multimediaData);
                echo "<video controls class='article-multimedia'>
                        <source src='$src' type='$fileType'>
                        Your browser does not support the video tag.
                      </video>";
            }
        }

      // ...

$content = stripslashes($row['content']);

// Modify the content using the provided code
$content = nl2br(str_replace(["\r\n\r\n", "\n\n", '\r\n'], "", removeBackslashes(str_replace('\\"', '"', htmlspecialchars_decode($content)))));

// Split content into paragraphs based on double line breaks
$paragraphs = explode("<br />", $content);

// Output each paragraph
echo "<div class='article-content'>";
foreach ($paragraphs as $paragraph) {
    echo "<p>$paragraph</p>";
}
echo "</div>";

// ...

        }
        echo "</div>";

        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
            echo "<div class='article-buttons'>";
            echo "<a href='edit_article.php?id=" . $row['id'] . "'>Edit</a>";
            echo "<a href='delete_article.php?id=" . $row['id'] . "'>Delete</a>";
            echo "</div>";
        }

        echo "<div class='comments-section'>";
        include('comments_section.php');
        echo "</div>";

    } else {
        echo "Article not found.";
    }

// Close the database connection
$stmt->close(); // Close the prepared statement
//$conn->close();
?>

                </ul>
            </div>

            <!-- Subscribe Section -->
            <section class="subscribe-section">
                <h3>Subscribe to Our Newsletter</h3>
                <p>Stay updated with our latest articles and news. Subscribe now!</p>
                <form action="process_subscribe.php" method="post">
                    <input type="text" placeholder="Your Name">
                    <input type="email" placeholder="Your Email">
                    <button type="submit">Subscribe</button>
                </form>
            </section>
        </div>
    </section> 

    <!-- Sidebar (Latest Articles List) -->
    <aside class="sidebar">
        <h4 style="text-align: center;">Recommended for you</h4>
        <ul class="latest-articles-list">
            <!-- List the first five articles here -->
            <?php
           
               include ('display_news.php');
              
            ?>
        </ul>
    </aside>
</main>

<footer>
<?php
include ('footer.php');
?>
</footer>
</body>
</html>
