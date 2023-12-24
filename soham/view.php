<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Data</title>
    <!-- Your CSS or Bootstrap link here -->
</head>
<body>

<h1>User Data</h1>

<table border="1px" cellpadding="10px" cellspacing="0">
    <tr>
        <th>Email</th>
        <th>Password</th>
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
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No records found</td></tr>";
    }

    // Close the database connection
    mysqli_close($con);
    ?>
</table>

</body>
</html>
