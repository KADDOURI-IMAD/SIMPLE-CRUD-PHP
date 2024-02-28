<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME</title>
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-nzohfU7KE3z8flxuk89t7p6OgCmkz1hm0jr6wozCOaCr4wlsDzV9dvL/E/Z2QDRofj9G+e+gI7+PUvyPhdykEg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS (Popper.js and jQuery are required) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Custom CSS for navbar */
    .navbar {
      background-color: #f5f5f5; /* Light gray background */
    }
    .navbar-brand,
    .navbar-nav .nav-link {
      color: #333; /* Dark gray text */
    }
    .navbar-brand:hover,
    .navbar-nav .nav-link:hover {
      color: #666; /* Light gray hover */
    }
    /* Custom CSS for footer */
    .custom-footer {
      background-color: #f5f5f5; /* Light gray background */
      color: #666; /* Dark gray text */
    }
    .custom-footer a {
      color: #666; /* Dark gray link text */
      text-decoration: none; /* Remove underline */
    }
    .custom-footer a:hover {
      color: #999; /* Light gray link text on hover */
    }
   
    .card-img-top {
    height: 200px; /* Set a fixed height for the images */
    object-fit: cover; /* Maintain aspect ratio and cover the entire space */
  }
  </style>
</head>
<body>
<?php require 'navb.php' ?>


<!--Cars available CARD -->
<div class="text-center mt-3">
    <h2 style="font-weight: bold; color: #333;">Cars available</h2>
</div>

<div class="card-container d-flex flex-column align-items-center"> <!-- Start of card container div -->
    <?php
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'fdwjee_php_prj');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch up to four car information from the database (assuming 'car' is the table name)
    $sql = "SELECT * FROM car";
    $result = mysqli_query($conn, $sql);

    // Check if there are any cars in the result
    if (mysqli_num_rows($result) > 0) {
        // Loop through the result and display each car as a card
        while ($row = mysqli_fetch_assoc($result)) {
            $carName = $row['name'];
            $carSpeed = $row['speed'];
            $carPrice = $row['prix'];
            $carImage = $row['picture'];
    ?>

    <div class="card border-info mb-3" style="height: 12rem; width: 65rem; border=">
        <div class="row g-0">
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $carName; ?></h5>
                    <p class="card-text">Speed: <?php echo $carSpeed; ?> <strong>KM/H</strong></p>
                    <p class="card-text">Price: <?php echo $carPrice; ?> <strong>MAD/D</strong></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="col-md-5">
                <img src="<?php echo $carImage; ?>" class="img-fluid" style="height: 12rem; width: 60rem;" alt="Car Image">
            </div>
        </div>
    </div>

    <?php
        }
    } else {
        echo "<p>No cars available.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</div> <!-- End of card container div -->


<!-- END OF Cars available CARD -->


























<?php require 'footer.php' ?>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
