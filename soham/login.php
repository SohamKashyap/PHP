<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Navbar style adjustments */
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        /* Enhance form appearance */
        .container {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Store Information</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/soham/form.php">Sign Up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/soham/login.php">Login</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-4">
<style>
        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #008000; /* Green color */
            margin-bottom: 30px;
            text-shadow: 1px 1px 1px #ccc; /* Adds a subtle shadow effect */
        }
    </style>
    <h1>LOGIN</h1>
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
    }
    ?>
    <form action="/soham/login.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
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
