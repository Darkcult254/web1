<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
// process_comment.php

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
    $article_id = $_POST['article_id'];
    $user = $_POST['user'];
    $comment = $_POST['comment'];

    // Use prepared statements to prevent SQL injection
    $sqlInsertComment = "INSERT INTO comments (article_id, user, comment, date) VALUES (?, ?, ?, NOW())";
    $stmtInsertComment = $conn->prepare($sqlInsertComment);
    $stmtInsertComment->bind_param("iss", $article_id, $user, $comment);

    if ($stmtInsertComment->execute()) {
        // Redirect back to the article page after submitting the comment
        header("Location: full_article.php?id=$article_id");
        exit();
    } else {
        echo "Error adding comment: " . $stmtInsertComment->error;
    }

    $stmtInsertComment->close(); // Close the prepared statement
}

$conn->close(); // Close the database connection
?>
