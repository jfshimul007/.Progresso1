<?php
include 'db.php'; // Include database connection if saving to DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Insert into database (if needed)
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='index.html#contact';</script>";
    } else {
        echo "<script>alert('Error sending message!'); window.location.href='index.html#contact';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
