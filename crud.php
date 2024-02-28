<?php
session_start();

// add a car
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["carName"]) && isset($_POST["carSpeed"]) && isset($_POST["carPrice"]) && isset($_FILES["carImage"])) {
        $carName = $_POST["carName"];
        $carSpeed = $_POST["carSpeed"];
        $carPrice = $_POST["carPrice"];
        $targetDir = "img_upl/";
        $targetFile = $targetDir . basename($_FILES["carImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // verification fake image
        if (!empty($_FILES["carImage"]["tmp_name"]) && getimagesize($_FILES["carImage"]["tmp_name"]) === false) {
            $_SESSION["errorMessage"] = "File is not an image.";
            $uploadOk = 0;
        }

        // check file size
        if ($_FILES["carImage"]["size"] > 500000) {
            $_SESSION["errorMessage"] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // allow file formats
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            $_SESSION["errorMessage"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // upload file if no errors
        if ($uploadOk == 1 && move_uploaded_file($_FILES["carImage"]["tmp_name"], $targetFile)) {
            $conn = mysqli_connect('localhost','root','','fdwjee_php_prj');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "INSERT INTO car (name, speed, prix, picture) VALUES ('$carName', '$carSpeed', '$carPrice', '$targetFile')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["successMessage"] = "New car added successfully";
            } else {
                $_SESSION["errorMessage"] = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        } elseif ($uploadOk == 0) {
            $_SESSION["errorMessage"] = "Sorry, there was an error uploading your file.";
        }

        header("Location: adminPage.php");
        exit;
    }
}

// deleting a car
if (isset($_GET["del"]) && $_GET["del"] > 0) {
    $carId = $_GET["del"]; 
    // connection to database
    $conn = mysqli_connect('localhost', 'root', '', 'fdwjee_php_prj');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM car WHERE id = $carId";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["successMessage"] = "Car deleted successfully";
    } else {
        $_SESSION["errorMessage"] = "Error deleting car: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    header("Location: adminPage.php");
    exit;
}

// Connect to your database
$conn = mysqli_connect('localhost', 'root', '', 'fdwjee_php_prj');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Code for updating a car
if (isset($_POST['updateCar'])) {
    $carId = $_POST['carId'];
    $carName = $_POST['editcarName'];
    $carSpeed = $_POST['editcarSpeed'];
    $carPrice = $_POST['editcarPrice'];

    // Check if the image field is empty or not
    if (!empty($_FILES['editcarImage']['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["editcarImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (!empty($_FILES["editcarImage"]["tmp_name"]) && getimagesize($_FILES["editcarImage"]["tmp_name"]) === false) {
            $_SESSION["errorMessage"] = "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["editcarImage"]["size"] > 500000) {
            $_SESSION["errorMessage"] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            $_SESSION["errorMessage"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Upload file if no errors
        if ($uploadOk == 1 && move_uploaded_file($_FILES["editcarImage"]["tmp_name"], $targetFile)) {
            // Update record with image
            $sql = "UPDATE car SET name='$carName', speed='$carSpeed', prix='$carPrice', picture='$targetFile' WHERE id='$carId'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["successMessage"] = "Car updated successfully with image.";
            } else {
                $_SESSION["errorMessage"] = "Error updating car: " . mysqli_error($conn);
            }
        } else {
            $_SESSION["errorMessage"] = "Sorry, there was an error uploading your file.";
        }
    } else {
        // Update record without image
        $sql = "UPDATE car SET name='$carName', speed='$carSpeed', prix='$carPrice' WHERE id='$carId'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["successMessage"] = "Car updated successfully without image.";
        } else {
            $_SESSION["errorMessage"] = "Error updating car: " . mysqli_error($conn);
        }
    }

    // Redirect back to the dashboard or any other appropriate page
    header("Location: adminPage.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
