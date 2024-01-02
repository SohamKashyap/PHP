<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo Animation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            overflow: hidden;
        }

        .logo-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: black; /* Change background color to black */
            z-index: 9999;
            transition: opacity 1s ease-in-out;
        }

        .logo {
            max-width: 80%;
            max-height: 80%;
        }

        .content {
            opacity: 0;
            transition: opacity 1s ease-in-out;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .logo-container.minimize {
            opacity: 0;
            pointer-events: none;
        }

        .logo-container.minimize + .content {
            opacity: 1;
        }
        header {
            height: 10%;
            background-color: black;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        main {
            height: 70%; /* Adjusted height for better visibility */
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        footer {
            height: 10%;
            background-color:black;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        header img {
            max-width: 200px; /* Adjust the maximum width of the image */
            max-height: 100px; /* Adjust the maximum height of the image */
            filter: brightness(1.5); /* Example filter: Increase brightness */
            /* Additional styles to position the image within the header */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        header {
            height: 10%;
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        nav {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        nav img {
            max-width: 200px; /* Adjust the maximum width of the image */
            max-height: 100px; /* Adjust the maximum height of the image */
            filter: brightness(1.5); /* Example filter: Increase brightness */
        }
    </style>
</head>
<body>
<header>
        <nav>
            <!-- Navigation links can be added here -->
            <div></div> <!-- Example empty div for left alignment -->
            <img src="local-nest-high-resolution-logo-white-transparent.png" alt="Header Logo">
            <!-- Add other navigation links or elements as needed -->
        </nav>
    </header>
    
    <main>
        <div class="logo-container">
            <img src="local-nest-high-resolution-logo-white-transparent.png" alt="Logo" class="logo">
        </div>
        <div class="content">
            <!-- Your page content goes here -->
            <h1>Welcome to Our Website</h1>
        </div>
    </main>
    <script>
            setTimeout(function() {
                document.querySelector('.logo-container').classList.add('minimize');
            }, 3000);
        </script>
    <footer>
        <p>&copy; Local Nest MCA</p>
    </footer>
</body>
</html>
