<?php
session_start();

// Database connection parameters
$servername = "localhost"; // Change this to your database server if it's not local
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "hatchery_management"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL statement to retrieve user from database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if query returned any rows
    if ($result->num_rows > 0) {
        // User exists, redirect to next page
        header("Location: Home.html");
        exit();
    } else {
        // User does not exist or password is incorrect
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    background-color: #c9d6ff;
    background: linear-gradient(to right, #e2e2e2, #c9d6ff);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

.container {
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.container p {
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span {
    font-size: 12px;
}

.container a {
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button {
    background-color: orange;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button:hover {
    background-color: #00a1ff;
}

.container button.hidden {
    background-color: transparent;
    border-color: #fff;
}

.container form {
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input {
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in {
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in {
    transform: translateX(100%);
}

@keyframes move {
    0%,
    49.99% {
        opacity: 0;
        z-index: 1;
    }
    50%,
    100% {
        opacity: 1;
        z-index: 5;
    }
}

.social-icons {
    margin: 20px 0;
}

.social-icons a {
    border: 1px solid #ccc;
    border-radius: 20%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;
}

.toggle-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.container.active .toggle-container {
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}

.toggle {
    background-color: linear-gradient(to left, #00a1ff, #00ff8f);
    height: 100%;
    background: linear-gradient(to right, green, #1D2671);
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container.active .toggle {
    transform: translateX(50%);
}

.toggle-panel {
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-left {
    transform: translateX(-200%);
}

.container.active .toggle-left {
    transform: translateX(0);
}

.toggle-right {
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right {
    transform: translateX(200%);
}

button {
    text-align: center;
}

img{
    border-radius: 170px;
    width: 200px;
    height: 200px;
}
    </style>
    <title>Login To Bhavani Hatchery</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form id="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1>Login In</h1>
                <span>Use your Username password</span>
                <div> Username:
                    <input type="text" placeholder="Enter username" id="username" name="username"> Password:
                    <input type="password" placeholder="Password" id="password" name="password">
                    <br></div>
                <br>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1> BHAVANI HATCHERY</h1>
                    <img src="https://media.istockphoto.com/id/1398473177/photo/questionnaire-with-checkboxes-filling-survey-form-online-answer-questions.jpg?s=612x612&w=0&k=20&c=sgZY6ojUqB0goVyn_9fKLfeyZ6lyWjSb3-FQjgeUPec=">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
