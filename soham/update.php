<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "form";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    $id = $_GET['id'];
    $select = "SELECT * FROM registraction WHERE id='$id'";
    $data = mysqli_query($con, $select);
    $row = mysqli_fetch_array($data);
    ?>
    <div class="container mt-4">
        <h1>Now Please Edit Your Email or Password</h1>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="<?php echo $row['Email']; ?>">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" value="<?php echo $row['Password']; ?>">
            </div>
            <button type="button" name="update_btn" class="btn btn-danger">Update Data</button>
            <style>
            .btn-secondary a {
                text-decoration: none;
                color: inherit; /* Keeps the link color same as button text color */
            }
              </style>
            <button type="button" class="btn btn-secondary"><a href="view.php">Back</a></button>
        </form>
    </div>

    <?php
    if (isset($_POST['update_btn'])) {
        $email = $_POST['email'];
        $password = $_POST['pass'];

        if (!$con) {
            die('Connection Error: ' . mysqli_connect_error());
        } else {
            // Hash the password before updating
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $update = "UPDATE registraction SET Email='$email', Password='$hashed_password' WHERE id='$id'";
            $data = mysqli_query($con, $update);

            if ($data) {
                ?>
                <script type="text/javascript">
                    alert("Data Updated Successfully");
                    window.open("http://localhost/soham/view.php","_self");
                    </script>
                    <?php
            } else {
                echo "Error: " . mysqli_error($con);
            }
            mysqli_close($con); // Close the connection after the operation
        }
    }
    ?>
</body>
</html>
