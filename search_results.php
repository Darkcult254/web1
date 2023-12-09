<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

    <!-- Include Raleway font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

    <style>
        body {
            font-family: 'Raleway', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .search-results {
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
        }

        hr {
            border: 1px solid #ddd;
        }
        .search-results {
            margin-top: 200px;
        }
        .results-info {
            font-size: 18px;
            font-weight: bold;
            color: #333; 
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    
<?php include 'header.php'; ?>

<div class="search-results">
<?php
    // Include database connection
    include 'db_connect.php';

    // Initialize the number of results variable
    $numResults = 0;

    // Check if the search form is submitted and the search term is not empty
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["search"])) {
        // Get the search term from the form
        $searchTerm = $_POST["search"];

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, title FROM articles WHERE title LIKE ? OR content LIKE ?");
        
        // Add wildcards to the search term to match any occurrence
        $searchTerm = "%" . $searchTerm . "%";
        
        // Bind the search term to the prepared statement
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result set
        $result = $stmt->get_result();

        // Update the number of results found
        $numResults = $result->num_rows;

        // Display the filtered search results
        if ($numResults > 0) {
            while ($row = $result->fetch_assoc()) {
                // Construct the link to the article using the article ID
                $articleLink = "full_article.php?id=" . $row["id"];
    ?>

                <div>
                    <h2><a href='<?php echo $articleLink; ?>'><?php echo $row["title"]; ?></a></h2>
                    <hr>
                </div>

    <?php
            }
        } else {
            echo "<p>No results found.</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p>Please enter a search term.</p>";
    }

    // Close the database connection
    $conn->close();
?>

    </div>
    


</body>
</html>
