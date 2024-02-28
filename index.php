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


<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" aria-label="Slide 1" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img_cars/image1.jpg" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500" alt="First slide">
        </div>
        <div class="carousel-item">
            <img src="img_cars/image3.jpg" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img src="img_cars/image4.jpg" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500" alt="Third slide">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- End of Carousel -->

<!--Cars available CARD -->
<div class="text-center mt-3">
    <h2 style="font-weight: bold; color: #333;">Cars available</h2>
</div>

<div class="card-container d-flex justify-content-center"> <!-- Start of card container div -->
    <?php
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'fdwjee_php_prj');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch up to four car information from the database (assuming 'car' is the table name)
    $sql = "SELECT * FROM car LIMIT 4";
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

<div class="card mx-2" style="width: 18rem;">
    <img src="<?php echo $carImage; ?>" class="card-img-top" alt="Car Image">
    <div class="card-body">
        <h5 class="card-title"><?php echo $carName; ?></h5>
        <p class="card-text">
            Speed: <?php echo $carSpeed; ?> <strong>KM/H</strong><br>
            Price: <?php echo $carPrice; ?> <strong>MAD/D</strong>
        </p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
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

<div class="text-center mt-3">
    <a href="carAvai.php" class="btn btn-primary">See more</a> <!-- See more button placed outside of the card container -->
</div>

<!-- END OF Cars available CARD -->


























<?php require 'footer.php' ?>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
