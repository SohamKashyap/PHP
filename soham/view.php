<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<h1>User Data</h1>
 &nbsp; <a href="form.php" class="btn btn-primary">Home</a>
<table border="1px" cellpadding="10px" cellspacing="0">
    <tr>
        <th>Email</th>
        <th>Password</th>
        <th colspan="2">Action</th>
    </tr>
    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "form";

    // Create connection
    $con = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch data from database
    $query = "SELECT * FROM registraction";
    $data = mysqli_query($con, $query);

    if (mysqli_num_rows($data) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($data)) {
            echo "<tr>
                    <td>" . $row["Email"] . "</td>
                    <td>" . $row["Password"] . "</td>
                    <td><a href='update.php?id=" . $row["ID"] . "'>Edit</a></td>
                    <td><a onclick=\"return confirm('Are you sure, you want to delete this data?')\" href='delete.php?id=" . $row["ID"] . "'>Delete</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }

    // Close the database connection
    mysqli_close($con);
?>

</table>

</body>
</html>
