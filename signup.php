<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $conn = new mysqli('localhost', 'root', '', 'UserAuth');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare('INSERT INTO Users (name, email, password) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $name, $email, $password);

    if ($stmt->execute()) {
        echo 'Account created successfully!';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
