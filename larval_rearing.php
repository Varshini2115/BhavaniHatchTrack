<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hatchery_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted to insert new record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $date = $_POST['date'];
    $tankNumber = $_POST['tankNumber'];
    $larvaeCount = $_POST['larvaeCount'];
    $foodType = $_POST['foodType'];
    $feedingFrequency = $_POST['feedingFrequency'];
    $feedingAmount = $_POST['feedingAmount'];
    $waterTemperature = $_POST['waterTemperature'];
    $waterSalinity = $_POST['waterSalinity'];
    $pH = $_POST['pH'];
    $tankCleanliness = $_POST['tankCleanliness'];

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO larvae_info (date, tank_number, larvae_count, food_type, feeding_frequency, feeding_amount, water_temperature, water_salinity, pH, tank_cleanliness) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siisisdddd", $date, $tankNumber, $larvaeCount, $foodType, $feedingFrequency, $feedingAmount, $waterTemperature, $waterSalinity, $pH, $tankCleanliness);

    // Execute statement
    if ($stmt->execute()) {
        $message = "Data inserted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Fetch history if requested
if (isset($_POST['history'])) {
    $sql = "SELECT * FROM larvae_info";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $historyTable = "<h2>History:</h2>";
        $historyTable .= "<table border='1'>";
        $historyTable .= "<tr><th>ID</th><th>Date</th><th>Tank Number</th><th>Larvae Count</th><th>Food Type</th><th>Feeding Frequency</th><th>Feeding Amount</th><th>Water Temperature</th><th>Water Salinity</th><th>pH</th><th>Tank Cleanliness</th></tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $historyTable .= "<tr>";
            $historyTable .= "<td>" . $row["id"] . "</td>";
            $historyTable .= "<td>" . $row["date"] . "</td>";
            $historyTable .= "<td>" . $row["tank_number"] . "</td>";
            $historyTable .= "<td>" . $row["larvae_count"] . "</td>";
            $historyTable .= "<td>" . $row["food_type"] . "</td>";
            $historyTable .= "<td>" . $row["feeding_frequency"] . "</td>";
            $historyTable .= "<td>" . $row["feeding_amount"] . "</td>";
            $historyTable .= "<td>" . $row["water_temperature"] . "</td>";
            $historyTable .= "<td>" . $row["water_salinity"] . "</td>";
            $historyTable .= "<td>" . $row["pH"] . "</td>";
            $historyTable .= "<td>" . $row["tank_cleanliness"] . "</td>";
            $historyTable .= "</tr>";
        }
        $historyTable .= "</table>";
    } else {
        $historyTable = "0 results";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larvae Rearing Information</title>
    <style>
      body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: white;
    background-color: #3b72c9; /* Blue */
    padding: 20px;
}


header {
    background-color: #3b72c9;
    padding: 20px;
    text-align: center;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

nav ul li a:hover {
    text-decoration: underline;
}

form {
    max-width: 500px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="date"],
input[type="number"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #ff8c00; /* Orange */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    margin-top: 10px;
}

button:hover {
    background-color: #ffa500; /* Lighter Orange */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th,
td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #4CAF50; /* Light Green */
    color: white;
}

/* Additional Styles for History Table */
.history-container {
    margin-top: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.history-heading {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

.history-table {
    width: 100%;
    border-collapse: collapse;
}

.history-table th,
.history-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.history-table th {
    background-color: #4CAF50; /* Light Green */
    color: white;
}

        </style>
</head>

<body>
    <h1>Larvae Rearing Information</h1>
    <?php
    // Show message if data inserted
    if (isset($message)) {
        echo "<p>$message</p>";
    }

    // Show insert form
    if (!isset($_POST['history']) || isset($message)) {
    ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br><br>

            <label for="tankNumber">Tank Number:</label>
            <input type="number" id="tankNumber" name="tankNumber" min="1" required><br><br>

            <label for="larvaeCount">Number of Larvae:</label>
            <input type="number" id="larvaeCount" name="larvaeCount" min="0" required><br><br>

            <label for="foodType">Food Type:</label>
            <select id="foodType" name="foodType" required>
                <option value="">Select Food Type</option>
                <option value="Artemia">Artemia</option>
                <option value="Microalgae">Microalgae</option>
                <option value="Commercial Feed">Commercial Feed</option>
                <option value="Other">Other</option>
            </select><br><br>

            <label for="feedingFrequency">Feeding Frequency (times/day):</label>
            <input type="number" id="feedingFrequency" name="feedingFrequency" min="0" required><br><br>

            <label for="feedingAmount">Feeding Amount (grams/day):</label>
            <input type="number" id="feedingAmount" name="feedingAmount" min="0" step="0.1" required><br><br>

            <label for="waterTemperature">Water Temperature (°C):</label>
            <input type="number" id="waterTemperature" name="waterTemperature" step="0.1" required><br><br>

            <label for="waterSalinity">Water Salinity (ppt):</label>
            <input type="number" id="waterSalinity" name="waterSalinity" step="0.1" required><br><br>

            <label for="pH">pH:</label>
            <input type="number" id="pH" name="pH" step="0.1" required><br><br>

            <label for="tankCleanliness">Tank Cleanliness (1-10):</label>
            <input type="number" id="tankCleanliness" name="tankCleanliness" min="1" max="10" required><br><br>

            <button type="submit" name="submit">Submit</button>
        </form>
    <?php
    }

    // Show history table
    if (isset($_POST['history']) && isset($historyTable)) {
        echo $historyTable;
    }
    ?>

    <?php if (isset($_POST['submit']) || !isset($_POST['history'])) { ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" name="history">History</button>
        </form>
    <?php } ?>
</body>

</html>
