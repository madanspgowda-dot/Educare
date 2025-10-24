<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'UserAuth');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare('SELECT password FROM Users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Redirect to index.html
            header('Location: index.html');
            exit;
        } else {
            echo 'Invalid password.';
        }
    } else {
        echo 'No account found with this email.';
    }

    $stmt->close();
    $conn->close();
}
?>
