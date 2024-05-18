<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Tracking</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #3b72c9;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1,
        h2 {
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .filters,
        .production-table {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .filters label {
            display: inline-block;
            margin-right: 10px;
            font-weight: bold;
        }

        .filters input,
        .filters select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 200px;
        }

        .filters button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .filters button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .new-data {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .new-data label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .new-data input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 200px;
            margin-bottom: 10px;
        }

        .new-data button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .new-data button:hover {
            background-color: #45a049;
        }
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    
    }

    /* Container styles */
    .container {
      width: 100%;
      height: 100%;
      --color: #E1E1E1;
      background-color: #F3F3F3;
      background-image: linear-gradient(0deg, transparent 24%, var(--color) 25%, var(--color) 26%, transparent 27%,transparent 74%, var(--color) 75%, var(--color) 76%, transparent 77%,transparent),
      linear-gradient(90deg, transparent 24%, var(--color) 25%, var(--color) 26%, transparent 27%,transparent 74%, var(--color) 75%, var(--color) 76%, transparent 77%,transparent);
      background-size: 55px 55px;
      max-width: 900px;
      margin: 60px auto;
      padding: 40px;
      border-radius: 40px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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

        header img {
            position: absolute;
            top: 8px; /* Adjust as needed */
            left: 8px; /* Adjust as needed */
            width: 50px; /* Adjust as needed */
            height: auto; /* Maintain aspect ratio */
        }

    /* Heading styles */
    h1 {
      text-align: center;
      color: #ffffff;
      margin-bottom: 30px;
    }

    p {
      color: white;
      text-align: center;
    }

    /* Button styles */
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
    .icon {
            position: absolute;
            left: 1rem;
            fill: #9e9ea7;
            width: 90px;
            height: 90px;
           border-radius: 100px;
        }
    button:hover::before {
      width: 250%;
    }

    @media (max-width: 300px) {
      .container {
        max-width: 80%;
      }
    }

    </style>
</head>

<body>
    <header>
        <h1>Production Tracking</h1>
    </header>

    <div class="container">
        <div class="filters">
            <h2>Filters</h2>
            <form action="" method="post">
                
                <div>
                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate" name="startDate">
                </div>
                <div>
                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate" name="endDate">
                </div>
                <button type="submit" name="filter">Filter</button>
            </form>
        </div>
        <div class="production-table">
            <h2>Production Data</h2>
            <table id="productionTable">
                <thead>
                    <tr>
                        <th>Tank Name</th>
                        <th>Harvest Date</th>
                        <th>Quantity (Units)</th>
                        <th>Size (g)</th>
                        <th>Survival Rate (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch and display production data
                    // Database connection parameters
                    $servername = "localhost"; // Assuming your database is hosted locally
                    $username = "root"; // Your database username
                    $password = ""; // Your database password
                    $dbname = "hatchery_management"; // Your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch data if the filter form is submitted
                    if (isset($_POST['filter'])) {
                        // Initialize the SQL query
                        $sql = "SELECT * FROM production_data WHERE 1";

                        // Add filters if provided
                        if (!empty($_POST['tank'])) {
                            $tank = $_POST['tank'];
                            $sql .= " AND tank_name = '$tank'";
                        }
                        if (!empty($_POST['startDate'])) {
                            $startDate = $_POST['startDate'];
                            $sql .= " AND harvest_date >= '$startDate'";
                        }
                        if (!empty($_POST['endDate'])) {
                            $endDate = $_POST['endDate'];
                            $sql .= " AND harvest_date <= '$endDate'";
                        }

                        // Execute the query
                        $result = $conn->query($sql);

                        // Check if there are any results
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["tank_name"] . "</td>";
                                echo "<td>" . $row["harvest_date"] . "</td>";
                                echo "<td>" . $row["quantity"] . "</td>";
                                echo "<td>" . $row["size"] . "</td>";
                                echo "<td>" . $row["survival_rate"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No results found</td></tr>";
                        }
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <div class="filters new-data">
            <h2>Add New Production Data</h2>
            <form method="post">
                <div>
                    <label for="newTankName">Tank Name:</label>
                    <input type="text" id="newTankName" name="newTankName" placeholder="Enter tank name">
                </div>
                <div>
                    <label for="newHarvestDate">Harvest Date:</label>
                    <input type="date" id="newHarvestDate" name="newHarvestDate">
                </div>
                <div>
                    <label for="newQuantity">Quantity (Units):</label>
                    <input type="number" id="newQuantity" name="newQuantity" placeholder="Enter quantity">
                </div>
                <div>
                    <label for="newSize">Size (g):</label>
                    <input type="number" id="newSize" name="newSize" placeholder="Enter size">
                </div>
                <div>
                    <label for="newSurvivalRate">Survival Rate (%):</label>
                    <input type="number" id="newSurvivalRate" name="newSurvivalRate" placeholder="Enter survival rate">
                </div>
                <button type="submit" name="add">Add</button>
            </form>
            <?php
// Database connection parameters
$servername = "localhost"; // Assuming your database is hosted locally
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "hatchery_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted for adding new data
if(isset($_POST['add'])) {
    // Get form data
    $tank_name = $_POST['newTankName'];
    $harvest_date = $_POST['newHarvestDate'];
    $quantity = $_POST['newQuantity'];
    $size = $_POST['newSize'];
    $survival_rate = $_POST['newSurvivalRate'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO production_data (tank_name, harvest_date, quantity, size, survival_rate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssidd", $tank_name, $harvest_date, $quantity, $size, $survival_rate);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

        </div>
    </div>
</body>

</html>
