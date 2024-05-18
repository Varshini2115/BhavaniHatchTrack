<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert and Show Food Details</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #ededed;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #fefefe;
            text-transform: uppercase;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        form {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #3972ce;
            color: #fff;
            padding: 8px;
            text-align: center;
            position: relative;
        }

        header img {
            position: absolute;
            top: 8px; /* Adjust as needed */
            left: 8px; /* Adjust as needed */
            width: 50px; /* Adjust as needed */
            height: auto; /* Maintain aspect ratio */
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 12px;
            width: 50%;
            height: 50%;
            margin-top: 10px;
            background-color: #09904a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #53a754;
        }

        .button {
            padding: 1em 2em;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 5px;
            text-transform: uppercase;
            cursor: pointer;
            color: #395cb5;
            transition: all 1000ms;
            font-size: 15px;
            position: relative;
            overflow: hidden;
            outline: 2px solid #395cb5;
        }

        button:hover {
            color: #ffffff;
            transform: scale(1.1);
            outline: 2px solid #f59815;
            box-shadow: 4px 5px 17px -4px #f59815;
        }

        button::before {
            content: "";
            position: absolute;
            left: -50px;
            top: 0;
            width: 0;
            height: 100%;
            background-color: #f59815;
            transform: skewX(45deg);
            z-index: -1;
            transition: width 1000ms;
        }

        button:hover::before {
            width: 250%;
        }

        .input {
            width: 100%;
            height: 40px;
            line-height: 28px;
            padding: 0 1rem;
            padding-left: 2.5rem;
            border: 2px solid transparent;
            border-radius: 8px;
            outline: none;
            background-color: #f3f3f4;
            color: #0d0c22;
            transition: 0.3s ease;
        }

        .input::placeholder {
            color: #9e9ea7;
        }

        .input:focus,
        input:hover {
            outline: none;
            border-color: rgba(247, 127, 0, 0.4);
            background-color: #fff;
            box-shadow: 0 0 0 4px rgb(247 127 0 / 10%);
        }

        .lg {
            height: 100px;
            width: 100px;
        }

        .icon {
            position: absolute;
            left: 1rem;
            fill: #9e9ea7;
            width: 100px;
            height: 100px;
            border-radius: 100px;
        }

        .container {
            width: 100%;
            height: 100%;
            --color: #E1E1E1;
            background-color: #F3F3F3;
            background-image: linear-gradient(0deg, transparent 24%, var(--color) 25%, var(--color) 26%, transparent 27%, transparent 74%, var(--color) 75%, var(--color) 76%, transparent 77%, transparent), linear-gradient(90deg, transparent 24%, var(--color) 25%, var(--color) 26%, transparent 27%, transparent 74%, var(--color) 75%, var(--color) 76%, transparent 77%, transparent);
            background-size: 55px 55px;
        }
    
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"],
        input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
// Your PHP code for inserting food details
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['showTable'])) {
    // Prepare data for insertion
    $costPerMeal = $_POST['costPerMeal'];
    $mealsPerDay = $_POST['mealsPerDay'];
    $numberOfPersonsPresent = $_POST['numberOfPersonsPresent'];
    $date = $_POST['date'];
    $total_cost = $_POST['totalCost'];

    // Create connection
    $conn = new mysqli("localhost", "root", "", "hatchery_management");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL INSERT statement
    $sql = "INSERT INTO food (costPerMeal, mealsPerDay, numberOfPersonsPresent, date, total_cost) VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("diisd", $costPerMeal, $mealsPerDay, $numberOfPersonsPresent, $date, $total_cost);

    
    if ($stmt->execute() === TRUE) {
        echo '<p class="success-message">New record created successfully</p>';
    } else {
        echo '<p class="error-message">Error: ' . $sql . '<br>' . $conn->error . '</p>';
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
<div class="container">
    <h2>Show Details within Date Range</h2>
    <form method="post">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" required><br>

        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" required><br>

        <input type="submit" name="showTable" value="Show Table">
    </form>

    <div id="tableContainer">
        <?php
        if(isset($_POST['showTable'])) {
            // Your PHP code to fetch and display the table based on the date range
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            // Create connection
            $conn = new mysqli("localhost", "root", "", "hatchery_management");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare SQL SELECT statement
            $sql = "SELECT * FROM food WHERE date BETWEEN ? AND ?";

            // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $startDate, $endDate);
            $stmt->execute();
            $result = $stmt->get_result();

            // Display table
            echo "<table border='1'>";
            echo "<tr><th>Cost Per Meal</th><th>Meals Per Day</th><th>Number of Persons Present</th><th>Date</th><th>Total Cost</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row['costPerMeal']."</td><td>".$row['mealsPerDay']."</td><td>".$row['numberOfPersonsPresent']."</td><td>".$row['date']."</td><td>".$row['total_cost']."</td></tr>";
            }
            echo "</table>";

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</div>
</body>
</html>
