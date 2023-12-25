<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<?php
// Establish database connection (assuming variables are defined)
$con = mysqli_connect("localhost", "root", "", "form");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Get the 'id' from GET parameters
$id = $_GET['id'];

// Sanitize and validate the 'id' parameter (example of basic validation)
if (!is_numeric($id)) {
    echo "Invalid ID";
    exit();
}

// Prepare the query using prepared statements
$query = "DELETE FROM registraction WHERE id = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt === false) {
    die("Prepare failed: " . mysqli_error($con));
}

// Bind the 'id' parameter
mysqli_stmt_bind_param($stmt, "i", $id) or die("Bind failed: " . mysqli_error($stmt));

// Execute the query
if (mysqli_stmt_execute($stmt)) {
    ?>
    <script type="text/javascript">
        alert("Data Deleted Successfully");
        window.open("http://localhost/soham/view.php","_self");
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Please try again!");
    </script>
    <?php
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
</body>
</html>
