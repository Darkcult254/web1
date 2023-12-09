<?php
// Start or resume a session
session_start();

$admin_username = "Igult_Admin1";
$admin_password = "Holighost2023";

// Function to check and destroy the session
function checkAndDestroySession() {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1200)) {
        session_unset();
        session_destroy();
        header("Location: admin_panel.php");
        exit;
    }
    $_SESSION['last_activity'] = time(); // Update last activity time
}

// Check if the login form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the provided credentials match the admin's credentials
    if ($username === $admin_username && $password === $admin_password) {
        // Set a session variable to indicate the user is logged in as an admin
        $_SESSION['is_admin'] = true;
        $_SESSION['last_activity'] = time(); // Set initial last activity time
    }
}

// Check if the user is logged in as an admin
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;

// Handle logout
if ($is_admin && isset($_POST['logout'])) {
    // Destroy the session to log the user out
    session_unset();
    session_destroy();
    // Redirect the user back to the login page
    header("Location: admin_panel.php");
    exit;
}

// Check and destroy session if the user is logged in
if ($is_admin) {
    checkAndDestroySession();
}
?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap">

</head>

<body>
    <?php
    // Check if the user is logged in as an admin
    if ($is_admin) {
    ?>
        <div style="text-align: center; padding-top: 0px !important;">
  <h3>IGULT ADMIN</h3>
</div>



        <!-- Add a Logout button -->
        <form id="logoutForm" action="admin_panel.php" method="POST" style="text-align: center;">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Logout" style="margin: 20px auto; display: block;">
    </form>

        <!-- Other forms in your HTML -->
        <div style="display: flex;">
            <!-- First Form (left) -->
            <div style="flex: 1; border: 1px solid #ccc; display: flex; flex-direction: column; position: relative; overflow: hidden;">
            <input type="text" id="search-input" placeholder="Search text" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; width: 700px; font-family: 'Raleway', sans-serif;
max-height: 1500px !important;">
        <!-- Include articles retrieved from articles_preview.php here -->
        <?php include('submission_form.html'); ?>
    </div>

            <div style="flex: 1; border: 1px solid #ccc; display: flex; flex-direction: column; position: relative; overflow: hidden;">
            <input type="text" id="search-input" placeholder="Search by Title" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; width: 700px; font-family: 'Raleway', sans-serif;">
    <div id="article-list" style="flex: 1; overflow-y: scroll; max-height: 1500px !important;">
        <!-- Include articles retrieved from articles_preview.php here -->
        <?php include('article_preview.php'); ?>
    </div>
</div>

</div>

</div>



</div>

    <?php
    } else {
        if (isset($_POST['logout'])) {
            // Display a message after successful logout
            echo '<p class="logout-message">You have been successfully logged out.</p>';
        }
        include('login_form.html');
    }

    // Check if the article was added successfully and display a message
    $articleAdded = isset($_POST['article_added']) && $_POST['article_added'] === 'true';
    if ($articleAdded) {
    ?>
        <p style="text-align: center;">Article posted successfully.</p>
        <p style="text-align: center;"><a href="admin_panel.php">Back to Admin Panel</a></p>
    <?php
    }
    ?>
    <script>
        // Set an inactivity timer to automatically log out the user
        var logoutTimer = setTimeout(function () {
            document.getElementById('logoutForm').submit();
        }, 1200000); // 20 minutes in milliseconds
    </script>
</body>

</html>

<style>
    body {
            font-family: 'Raleway', sans-serif;
        }
#article-list {
    flex: 1;
    overflow-y: scroll;
    max-height: 100% !important; /* Adjust the percentage as needed */
}


</style>
