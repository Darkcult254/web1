<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include('db_connect.php');

// Function to sanitize input data
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags($input));
}

// Collect data from the form
$first_name = sanitizeInput($_POST['first-name']);
$last_name = sanitizeInput($_POST['last-name']);
$email = sanitizeInput($_POST['email']);
$message = sanitizeInput($_POST['message']);

// Validate input
if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
    die("Please fill in all fields.");
}

// Insert data into the database using prepared statements
$sql = "INSERT INTO contact_messages (first_name, last_name, email, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $first_name, $last_name, $email, $message);

if ($stmt->execute()) {
    // Data inserted successfully
    // Send an email using PHP's mail function
    $to = "antiperhenryotieno@gmail.com"; // Replace with your recipient's email address
    $subject = "New Contact Form Submission";
    $email_message = "You have received a new contact form submission:\n\nFirst Name: $first_name\nLast Name: $last_name\nEmail: $email\nMessage: $message";
    
    // Use the mail function to send the email
    if (mail($to, $subject, $email_message)) {
        // Email sent successfully
        header("Location: thank_you.html");
    } else {
        //echo "but unfortunately ,this function is under maintenance.Kindly use whatsapp,or phone number at  the  topbar to directly contact IGULT support.Thank you for your  understanding";
    }
} else {
    // Handle the database error
    echo "Error: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
