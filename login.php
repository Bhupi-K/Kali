<?php
// Change these values with your MySQL server credentials
$dsn = "mysql:host=localhost;dbname=Hydra";
$username = "root";
$password = "root";

try {
    // Create a PDO instance
    $conn = new PDO($dsn, $username, $password);

    // Set PDO to throw exceptions on error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
        $stmt->execute(array('username' => $username, 'password' => $password));

        // Check if user exists
        if ($stmt->rowCount() == 1) {
            // Login successful
            echo "Login successful!";
        } else {
            // Login failed
            echo "Login failed. Invalid username or password.";
        }
    }
} catch(PDOException $e) {
    // Print error message if connection fails
    echo "Connection failed: " . $e->getMessage();
}
?>
