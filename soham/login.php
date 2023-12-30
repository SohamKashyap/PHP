<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
            color: #fff; /* Set text color to white */
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Set text color for headings */
        h1 {
            text-align: center;
            font-size: 3rem;
            color: #fff; /* White color */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Set text color for form labels */
        label {
            color: #fff; /* Set label text color to white */
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
    </style>
</head>
<style>
        /* Add background image */
        body {
            background-image: url('https://r4.wallpaperflare.com/wallpaper/683/186/563/macos-mojave-day-wallpaper-13a4fdadfc0811bfe145278604fcd852.jpg'); /* Replace 'path_to_your_image.jpg' with the URL or path to your image */
            background-size: cover; /* Cover the entire viewport */
            background-attachment: fixed; /* Fix the background image */
            color: #333; /* Text color */
        }
        
    </style>
<body>
<nav class="navbar">
    <div class="container">
        <h1 class="logo">MCA</h1>
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
    // PHP code for login validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "form";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $email = $_POST['email'];
        $stmt = $conn->prepare("SELECT * FROM registraction WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password_from_db = $row['Password']; // Replace 'Password' with your column name
            $entered_password = $_POST['pass']; // Get the password entered during login
            if (password_verify($entered_password, $hashed_password_from_db)) {
              echo '<div id="alertMsg" class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Login successfully!</strong>  
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            } else {
              echo '<div id="alertMsg" class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Incorrect Password! Enter Again !</strong>  
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            }
        } else {
          echo '<div id="alertMsg" class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>User With this Email Does not Exist , Enter Again !</strong>  
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        } 
        
        $stmt->close();
        $conn->close();
    } else {
      echo '<div id="alertMsg" class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Enter Your Email and Password to Log In!</strong>  
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
            opacity: 0.6; /* Adjust opacity */
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
        <h1 class="signup-text">Log In</h1>
    </div>
   
    <form action="/soham/login.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Password</label>
            <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <button type="submit" class="btn btn-success">Log In</button>
        <a href="/soham/form.php" class="btn btn-primary">Sign Up</a>
    </form>

    
</div>
</body>
</html>
