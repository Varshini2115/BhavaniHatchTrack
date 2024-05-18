<?php
// Database connection parameters
$servername = "localhost"; // Change if your MySQL server is hosted elsewhere
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "hatchery_management"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert new instructions
function insertInstructions($conn) {
    if(isset($_POST['Date']) && isset($_POST['Details'])) {
        $Date = $_POST['Date'];
        $Details = $_POST['Details'];

        // Insert data into task_queue table
        $sql = "INSERT INTO works (Date, Details) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $Date, $Details);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }
}

// Fetch instructions between dates
function fetchInstructions($conn, $startDate, $endDate) {
    // Fetch data from task_queue table within the specified date range
    $sql = "SELECT * FROM works WHERE Date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display table
    if ($result->num_rows > 0) {
        echo "<h2>Tasks between $startDate and $endDate</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Date</th><th>Details</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['ID']."</td>";
            echo "<td>".$row['Date']."</td>";
            echo "<td>".$row['Details']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No tasks found between $startDate and $endDate.</p>";
    }

    // Close statement
    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitInsert'])) {
        insertInstructions($conn);
    }
    if (isset($_POST['submitFetch'])) {
        $startDate = $_POST['StartDate'];
        $endDate = $_POST['EndDate'];
        fetchInstructions($conn, $startDate, $endDate);
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Queue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F3F3F3;
            background-image: linear-gradient(0deg, transparent 24%, #E1E1E1 25%, #E1E1E1 26%, transparent 27%,transparent 74%, #E1E1E1 75%, #E1E1E1 76%, transparent 77%,transparent), linear-gradient(90deg, transparent 24%, #E1E1E1 25%, #E1E1E1 26%, transparent 27%,transparent 74%, #E1E1E1 75%, #E1E1E1 76%, transparent 77%,transparent);
            background-size: 55px 55px;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 40px;
            display: flex;
            flex-direction: column; /* Stack buttons vertically */
            align-items: center; /* Center buttons horizontally */
        }
        header {
            background-color: #3972ce;
            color: #fff;
            padding: 7px;
            text-align: center;
            position: relative;
        }

        h1, h2 {
            text-align: center;
            color: #ffffff;
        }

        form, table {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
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
            background: transparent;
            margin: 20px 0; /* Adjust margin for spacing */
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
        .icon {
            position: absolute;
            left: 1rem;
            fill: #9e9ea7;
            width: 90px;
            height: 90px;
           border-radius: 100px;
        }

        .instructions {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header><h1>Task Queue</h1></header> <br><br>
    <div class="container">
      
        <form id="Form" method="post">
         
            <label for="Date">Mention Date:</label>
            <input type="date" id="Date" name="Date" required>

            <label for="Details">Details:</label>
            <textarea id="Details" name="Details" required></textarea>

            <button type="submit" name="submitInsert">Submit</button>
           
        </form>
        </div>
<br>
        <header><h2>Previous Tasks</h2></header><br><br>
        <div class="container">
        <form id="FetchForm" method="post">
            <label for="StartDate">Start Date:</label>
            <input type="date" id="StartDate" name="StartDate" required>

            <label for="EndDate">End Date:</label>
            <input type="date" id="EndDate" name="EndDate" required>
<br><br>
            <button type="submit" name="submitFetch">Show previous tasks</button>
        </form>
        </div>
        <div id="Instructions">
            <!-- Previous tasks will be displayed here -->
        </div>
    </div>
</body>
</html>
