<?php
session_start();

// Check if the login was unsuccessful and display an alert
if (!isset($_SESSION['unsuccessful_message_displayed']) && isset($_GET['login']) && $_GET['login'] == 'unsuccessful') {
    echo '<div id="unsuccessful-alert" class="alert alert-danger" role="alert">Login unsuccessful! Please try again.</div>';
    
    // Set a session variable to indicate that the success message has been displayed
    $_SESSION['unsuccessful_message_displayed'] = true;
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<title>Admin Login</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require 'navb.php' ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Admin Login</h2>
                </div>
                <div class="card-body">
                    <form action="admin.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php' ?>
<script>
// JavaScript to hide alert after 3 seconds
setTimeout(function(){
    document.getElementById('unsuccessful-alert').style.display = 'none';
}, 3000);
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
