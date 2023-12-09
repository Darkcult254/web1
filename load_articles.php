<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "igult_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT articles.id, articles.title, articles.content, articles.author, articles.date_submitted, articles.category_id, multimedia_files.filename, multimedia_files.filetype, multimedia_files.filedata
        FROM articles
        LEFT JOIN multimedia_files ON articles.id = multimedia_files.article_id
        WHERE articles.category_id = (SELECT id FROM categories WHERE name = 'BLOG')
        ORDER BY articles.date_submitted DESC";

$result = $conn->query($sql);

$articles = [];

if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

echo json_encode($articles);

$conn->close();
?>
