<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>

        /* Enhance form appearance */
        .container {
            background-color: transparent; /* Make the container transparent */
            padding: 20px;
            border-radius: 8px;
            box-shadow: none; /* Remove the box shadow */
        }

        .btn-secondary a {
            text-decoration: none;
            color: inherit;
        }

        /* Customize form inputs */
        input[type="email"],
        input[type="password"] {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.5); /* Add some opacity to the input background */
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        </style>
</head>

        <style>
                /* Add background image */
                        body {
                background-image: url('https://r4.wallpaperflare.com/wallpaper/621/301/89/macos-mojave-night-wallpaper-33048d6dbcf8413fb105175654ac0812.jpg');
                background-size: cover;
                background-attachment: fixed;
                color: #333;
    }

                /* Make the form slightly transparent */
                .container {
        background-color: rgba(247, 247, 247, 0); /* Transparent background */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0);
        color: #fff; /* White text color */
    }

            </style>


<style>
        /* Reset some default browser styles */
        body, h1, h2, h3, h4, h5, h6, ul, li {
            margin: 0;
            padding: 0;
            list-style: none;
            font-family: Arial, sans-serif;
        }

        /* Navbar styles */
        .navbar {
        background-color: #000; /* Change to black */
        color: #fff;
    }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

            .logo {
            font-size: 24px;
            font-weight: bold;
            text-decoration: underline;
            /* Additional styling */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            transition: color 0.3s ease-in-out;
            /* Example color and underline style */
            color: #fff;
        }

        .nav-links li {
            display: inline-block;
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
        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-img {
            max-width: 60px;
            margin-right: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
    <img src="https://imgs.search.brave.com/a5cRiBKwRSjeiA5UCyXmaQtgDCMejbNFfLkme3_-1X8/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9ndW1s/ZXQuYXNzZXR0eXBl/LmNvbS9mcmVlcHJl/c3Nqb3VybmFsLzIw/MjItMDUvOTEyODg5/MjUtOTIzNi00ZmY2/LThmOTUtMzEzZmVm/MzBlYTM4L0xvZ29T/UFUucG5n" alt="Logo" class="logo-img">
        <h1 class="logo">Sardar Patel University, Mandi(MCA)</h1>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
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

<div class="container mt-4">
<style>
        /* Style for the container */
        .signup-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Shadow effect */
            background: linear-gradient(45deg, #007bff, #00ffcc); /* Gradient background */
            opacity: 0.7; /* Adjust opacity */
        }

        /* Style for the text */
        .signup-text {
            font-size: 3rem;
            color: #fff; /* White color */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin: 0; /* Remove default margin */
        }
    </style>
</head>
<body>
    <div class="signup-box">
        <h1 class="signup-text">Sign Up</h1>
    </div>
   
        <form action="/soham/form.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>

            <a href="login.php" class="btn btn-success" role="button">Log In</a>
            
        </form>
    </div>
</body>
</html>
