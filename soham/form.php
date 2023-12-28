
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    <!-- JavaScript to remove the alert after 4 seconds -->
    <script>
        setTimeout(function() {
            document.getElementById('alertMsg').style.display = 'none';
        }, 4000); // 4000 milliseconds = 4 seconds
    </script>

    <div class="container mt-4">
        <h1> Enter Your Email and Password for Sign Up </h1>
        <form action="/soham/form.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <style>
                .btn-secondary a {
                    text-decoration: none;
                    color: inherit;
                }
            </style>
            <button type="view" class="btn btn-secondary"><a href="view.php">View Data</a></button>
            <a href="login.php" class="btn btn-success" role="button">Log In</a>
        </form>
    </div>
</body>
</html>
