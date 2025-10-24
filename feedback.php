<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$host = 'localhost'; // Database host
$dbname = 'feedbackdb'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    // Establish database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch data from the feedback table
    $query = "SELECT * FROM feedback";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Fetch all data as an associative array
    $feedbackData = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            text-align: center;
            padding: 2rem;
            background-color: #0077b6;
            color: white;
        }
        header h1 {
            margin: 0;
        }
        table {
            width: 80%;
            margin: 2rem auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 1rem;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #0077b6;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        footer {
            text-align: center;
            padding: 1rem;
            background: #023e8a;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>Feedback Records</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Feedback</th>
                    <th>Rating</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($feedbackData)) : ?>
                    <?php foreach ($feedbackData as $row) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']); ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['feedback']); ?></td>
                            <td><?= htmlspecialchars($row['rating']); ?></td>
                            <td><?= htmlspecialchars($row['submitted_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No feedback records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2025 Feedback System</p>
    </footer>
</body>
</html>
