<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Style for the comment form container */
.comments-section form {
    margin-top: 20px;
    border-top: 1px solid #ccc;
    padding-top: 20px;
}

/* Style for the comment form labels */
/* Style for the name label within the comment form */
.comments-section form label[for="user"] {
    width: 50% !important; /* Adjust the width as needed */
    display: inline-block; /* Ensures that the label and input appear on the same line */
    margin-bottom: 8px;
    font-weight: bold;
}

input  {
    width: 50%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid transparent; 
    border-radius: 4px;
   
}


.comments-section textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid transparent; 
    border-radius: 4px;
}

/* Style for the submit button */
.comments-section button {
    background-color: #6CB4EE;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.comments-section button:hover {
    background-color: black;
}

.comments-section {
    max-width: 600px; /* Adjust the max-width as needed */
    margin: auto;
}

.comment-card {
    border: 1px solid transparent; 
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
    
}

.comment-name {
    font-weight: bold;
}

.comment-date {
    color: #555;
    margin-bottom: 5px;
}

.comment-text {
    margin-bottom: 0;
}

        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

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
?>
<!-- Display existing comments -->
<h3 style="margin-top: 250px; margin-bottom: 20px; text-align: center; border-bottom: 2px solid #999; width: 100%; padding-bottom: 5px !important; color: blue;">Comments</h3>

<div class='comments-section'>
    <?php
    // Display existing comments for the article
    $sqlComments = "SELECT user, comment, date FROM comments WHERE article_id = ?";
    $stmtComments = $conn->prepare($sqlComments);
    $stmtComments->bind_param("i", $article_id);
    $stmtComments->execute();
    $resultComments = $stmtComments->get_result();

    if ($resultComments !== false && $resultComments->num_rows > 0) {
        while ($rowComment = $resultComments->fetch_assoc()) {
            echo "<div class='comment-card'>";
            echo "<p class='comment-date'>" . date("F j, Y, g:i a", strtotime($rowComment['date'])) . "</p>";
            echo "<p class='comment-name'>" . stripslashes($rowComment['user']) . "</p>";

            // Convert URLs to clickable links
            $commentText = stripslashes($rowComment['comment']);
            $commentTextWithLinks = preg_replace('/(http[s]?:\/\/[^\s]+)/', '<a href="$1" target="_blank">$1</a>', $commentText);
            echo "<p class='comment-text'>" . $commentTextWithLinks . "</p>";

            echo "</div>";
        }
    } else {
        // No comments yet.
        echo "<p>No comments yet.</p>";
    }
    ?>

    <!-- Comment Form -->
    <h4 style="text-align: center; color: blue;">Leave a comment :</h4>

    <form method="post" action="process_comment.php">
        <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">

        <label for="user">Name:</label>
        <input type="text" id="user" name="user" required placeholder="Click here to enter your name" style="color: darkblue; font-family: 'Raleway', sans-serif;"><br>

        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" rows="4" required placeholder="Click here to enter your comment" style="color: darkblue; font-family: 'Raleway', sans-serif;"></textarea><br>

        <button type="submit">Post</button>
    </form>
</div>

<?php
// Close the database connection
$conn->close();
?>



<script>
    document.getElementById('commentForm').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // prevent the default form submission
            document.getElementById('commentForm').submit();
        }
    });
</script>
</body>
</html>