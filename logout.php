<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        html {
            background: #aaa7a5;
        }
        body {
            background: #aaa7a5;
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
session_start();

// Unset the admin session variable
unset($_SESSION['isAdmin']);

// Redirect to the login page
header("Location: login.php");
exit();
?>
