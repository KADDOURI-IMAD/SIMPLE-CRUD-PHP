<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    .action-column {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .action-column a {
        margin: 0 5px;
        text-decoration: none;
        border-radius: 5px;
        padding: 5px 15px; /* Increased padding */
    }
    .action-column a.btn-edit {
        background-color: #007bff;
        color: #fff;
    }
    .action-column a.btn-delete {
        background-color: #dc3545;
        color: #fff;
    }
    .action-column a:hover {
        opacity: 0.8;
    }
</style>
<body>

<nav class="navbar navbar-dark bg-dark"> 
    <a class="navbar-brand">Dashboard</a>
    <form method="post">
    <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="logout">Logout</button>
    </form>
</nav>

<!-- Login Alert -->
<?php
    session_start();
    if (!isset($_SESSION['success_message_displayed']) && isset($_GET['login']) && $_GET['login'] == 'successful') {
        echo '<div id="success-alert" class="alert alert-success" role="alert">Login successful!</div>';
        
        // Set a session variable to indicate that the success message has been displayed
        $_SESSION['success_message_displayed'] = true;
    }

    if (isset($_POST['logout'])){
        session_destroy();
        header('location:dashboard.php');
    }
?>

<!-- Add Car Alert -->
<div class="container mt-5">
    <?php if(isset($_SESSION["errorMessage"])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["errorMessage"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION["errorMessage"]); ?>
    <?php endif; ?>
    <?php if(isset($_SESSION["successMessage"])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["successMessage"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION["successMessage"]); ?>
    <?php endif; ?>
</div>

<!-- Table for affichage -->
<div class="container mt-5">

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>Cars List</h2>
            </div>
            <div class="col-auto">
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCarModal">
                    Add New Car
                </button>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addCarModal" tabindex="-1" role="dialog" aria-labelledby="addCarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCarModalLabel">Add New Car</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to add a new car -->
                    <form action="crud.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="carName">Car Name</label>
                            <input type="text" class="form-control" id="carName" name="carName" required>
                        </div>
                        <div class="form-group">
                            <label for="carSpeed">Car Speed</label>
                            <input type="number" class="form-control" id="carSpeed" name="carSpeed" required>
                        </div>
                        <div class="form-group">
                            <label for="carPrice">Car Price</label>
                            <input type="number" class="form-control" id="carPrice" name="carPrice" required>
                        </div>
                        <div class="form-group">
                            <label for="carImage">Car image</label>
                            <input type="file" class="form-control" id="carImage" name="carImage" accept=".jpg, .png, .svg" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Car</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <!-- Edit Modal -->
<div class="modal fade" id="editCarModal" tabindex="-1" role="dialog" aria-labelledby="editCarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCarModalLabel">Edit Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to edit car information -->
                <form action="crud.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="carId" id="editcarId">
                    <div class="form-group">
                        <label for="editcarName">Car Name</label>
                        <input type="text" class="form-control" id="editcarName" name="editcarName" required>
                    </div>
                    <div class="form-group">
                        <label for="editcarSpeed">Car Speed</label>
                        <input type="number" class="form-control" id="editcarSpeed" name="editcarSpeed" required>
                    </div>
                    <div class="form-group">
                        <label for="editcarPrice">Car Price</label>
                        <input type="number" class="form-control" id="editcarPrice" name="editcarPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="editcarImage">Car Image</label>
                        <br>
                        <img id="editcarImageDisplay" src="" alt="Car Image" style="max-width: 100%;">
                        <input type="file" class="form-control-file mt-2" id="editcarImage" name="editcarImage" accept=".jpg, .png, .svg">
                    </div>
                    <button type="submit" class="btn btn-primary" name="updateCar">Update Car</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <div class="container mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Speed</th>
                    <th>Prix</th>
                    <th>Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to your database
                $conn = mysqli_connect('localhost', 'root', '', 'fdwjee_php_prj');

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Select data from the database
                $sql = "SELECT id, name, speed, prix, picture FROM car";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['speed'] . "</td>";
                        echo "<td>" . $row['prix'] . "</td>";
                        echo "<td><img src='" . $row['picture'] . "' width='100' height='100'></td>";
                        echo "<td>
                                <button class='btn btn-primary btn-sm editcar' data-img='" . $row['picture'] . "'>Edit</button>
                                <button onclick=\"confirm_del(" . $row['id'] . ")\" class='btn btn-danger btn-sm'>Delete</button>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function confirm_del(id) {
        if(confirm("Are you sure you want to delete this car?")) {
            window.location.href = "crud.php?del=" + id;
        }
    }
</script>
<script>
    $(document).ready(function(){
        $('.editcar').on('click', function(){
            $('#editCarModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.find("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);
            
            $('#editcarId').val(data[0]); // Assuming ID is in the first column
            $('#editcarName').val(data[1]);
            $('#editcarSpeed').val(data[2]);
            $('#editcarPrice').val(data[3]);
            
            // Set image source only if it's not empty
            var imageURL = $(this).data('img').trim(); // Trim whitespace
            if (imageURL) {
                $('#editcarImageDisplay').attr('src', imageURL); // Assuming image URL is in the fourth column
            } else {
                // Handle case when image URL is empty
                console.log("Image URL is empty or invalid.");
                // Optionally, you can display a placeholder image or hide the image display element.
            }
        });
    });
</script>

<script>
    // JavaScript to hide alert after 3 seconds
    setTimeout(function(){
        document.getElementById('success-alert').style.display = 'none';
    }, 3000);

    setTimeout(function(){
        $(".alert").alert('close');
    }, 3000);
</script>

</body>
</html>
