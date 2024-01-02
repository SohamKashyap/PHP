<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .navbar {
            background-color: #000;
            color: #fff;
            padding: 10px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            list-style: none;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            margin-right: 20px;
        }

        .nav-links li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .nav-links li a:hover {
            color: #ffcc00;
        }

        .logo-img {
            max-width: 150px;
            height: auto;
        }

        .container {
            padding: 20px;
            border-radius: 8px;
            color: #fff;
        }

        /* Custom styling for the alert message */
        .alert {
            position: relative;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            opacity: 0.9;
            color: #fff;
            border: 1px solid transparent;
        }


        .btn-close {
            color: inherit;
            text-decoration: none;
        }

        .btn-close:hover {
            color: inherit;
        }

        /* Signup box styles */
        .signup-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #007bff, #00ffcc);
            opacity: 0.7;
        }

        .signup-text {
            font-size: 3rem;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin: 0;
        }
    </style>
</head>
<nav class="navbar">
    <div class="container">
    <img src="local-nest-high-resolution-logo-white-transparent.png" alt="Logo" class="logo-img">
        <ul class="nav-links">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li><a href="main.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="view.php">View Data</a></li>
        </ul>
    </div>
</nav>
<style>
        /* Rest of your styles */

        /* Custom styling for the alert message */
        .alert {
            position: relative;
            padding: 1rem 1rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            opacity: 0.9; /* Adjust opacity to make it transparent */
            color: #fff; /* Text color */
            border: 1px solid transparent; /* Remove border */
        }

        /* Danger alert style */
        .alert-danger {
            background-color: rgba(255, 0, 0, 0.5); /* Red semi-transparent background */
        }

        /* Success alert style */
        .alert-success {
            background-color: rgba(0, 128, 0, 0.5); /* Green semi-transparent background */
        }

        /* Close button */
        .btn-close {
            color: inherit;
            text-decoration: none;
        }

        /* Hover effect for close button */
        .btn-close:hover {
            color: inherit;
        }
    </style>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['pass'];

        if (empty($email) || empty($password)) {
            echo '<div id="alertMsg" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Enter both Email and password!</strong>  
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } else {
            $conn = new mysqli('localhost', 'root', '', 'form');
            if ($conn->connect_error) {
                die('Connection Error: ' . $conn->connect_error);
            } else {
                // Hash the password using bcrypt
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO registraction(email, password) VALUES(?, ?)");
                $stmt->bind_param("ss", $email, $hashed_password);
                if ($stmt->execute()) {
                    echo '<div id="alertMsg" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Your Email and Password have been submitted successfully!</strong>  
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } else {
                    echo "Error: " . $conn->error;
                }
                $stmt->close();
                $conn->close();
            }
        }
    } else {
        echo '<div id="alertMsg" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please Enter Email and Password to store in database!</strong>  
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>

<style>
        body {
            background-color: #000;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sign-up-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
            padding: 50px 15px;
            color: #000;
        }

        .sign-up-logo img {
            max-width: 200px;
            height: auto;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
            color: #fff;
        }

        /* Updated styles for buttons */
        .btn-primary,
        .btn-success {
            margin-top: 10px;
            width: calc(50% - 5px); /* Equal width for both buttons with a slight margin */
        }
    </style>
<body>

    <div class="sign-up-container">
        <div class="sign-up-logo">
            <img src="sign-up-high-resolution-logo-transparent.png" alt="Sign Up">
        </div>
        <form action="/soham/form.php" method="post" class="signup-form">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="login.php" class="btn btn-success">Log In</a>
            </div>
        </form>
    </div>
</body>
</html>
