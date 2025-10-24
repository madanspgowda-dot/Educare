<?php
$host = 'localhost';
$dbname = 'Feedbackdb';
$username = 'root';
$password = '';

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $feedback = $_POST['feedback'];
        $rating = $_POST['rating'];

        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO Feedback (name, email, feedback, rating) 
                                VALUES (:name, :email, :feedback, :rating)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':feedback', $feedback);
        $stmt->bindParam(':rating', $rating);

        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Failed to submit feedback.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
