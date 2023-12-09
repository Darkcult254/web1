<?php
// Include the database connection
include 'db_connect.php';

// Process the form submission
if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Insert the subscriber data into the 'subscribers' table
    $sql = "INSERT INTO subscribers (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Thank you message
        echo "Thank you for subscribing!";

        // Send an email notification
        $to = "antiperhenryotieno@gmail.com";
        $subject = "New Subscriber";
        $message = "A new subscriber has joined your blog. Name: $name, Email: $email";
        $headers = "From: igult@gmail.com"; // Replace with your email address

        // Use the mail() function to send the email
        mail($to, $subject, $message, $headers);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
