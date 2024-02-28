<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=fdwjee_php_prj", 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to fetch user from database
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username=:username AND password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Check if user exists
        if ($stmt->rowCount() == 1) {
            // Login successful
            session_start();
            $_SESSION['adminLogId'] = $username;
            header("Location: adminPage.php?login=successful");
        } else {
             // Login unsuccessful
             session_start();
             header("Location: dashboard.php?login=unsuccessful");
            
        }
    } catch (Exception $e) {
        die("Connection failed: " . $e->getMessage());
    } finally {
        $conn = null; // Close the connection
    }
}

?>
