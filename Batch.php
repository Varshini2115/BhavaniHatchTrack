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
    $batchName = $_POST['Batchname'];
    $startDate = $_POST['startdate'];
    $amountInvested = $_POST['amountinvisted'];
    $supplier = $_POST['supplier'];
    $supplierPhone = $_POST['supplier-phone'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $healthStatus = $_POST['health-status'];

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO batch_details (batch_name, start_date, amount_invested, supplier, supplier_phone, quantity, unit, health_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssiss", $batchName, $startDate, $amountInvested, $supplier, $supplierPhone, $quantity, $unit, $healthStatus);

    // Execute statement
    if ($stmt->execute()) {
        $message = "Data inserted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Fetch data from batch_details table if requested
if (isset($_POST['show_details'])) {
    $sql = "SELECT * FROM batch_details";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hatchery Management System</title>
    <style>
      body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color:  #3b72c9;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    #main-content {
      padding: 20px;
    }

    form {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }
    button:hover {
            background-color: #3767b6;
        }
    input[type="text"],
    input[type="date"],
    input[type="number"] {
      width: 100%;
      padding: 8px;
      margin: 5px 0;
      box-sizing: border-box;
    }
    button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 20%;
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
    .container {
    max-width: 1200px; /* Increased max-width */
    margin: 20px auto;
    padding: 40px; /* Increased padding */
    border: 1px solid #474646;
    border-radius: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
}

.container1 {
    max-width: 800px; /* Increased max-width */
    margin: 20px auto;
    padding: 40px; /* Increased padding */
    border: 1px solid #474646;
    border-radius: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
}


    footer {
      background-color:  #3b72c9;
      color: #fff;
      text-align: center;
      padding: 5px; /* Reduced padding */
      position: fixed;
      bottom: 0;
      width: 100%;
      font-size: 12px; /* Reduced font size */
    }

    /* Inventory styles */
    .inventory-list {
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1); /* Add shadow to table */
        }

        th,
        td {
            padding: 12px 18px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #505151;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <h1>Batch Details</h1>
    </header>

    <section id="main-content">
        <div class="container1">
            <h2>Add New Prawn Batch </h2>
            <?php
            // Show message if data inserted
            if (isset($message)) {
                echo "<p>$message</p>";
            }
            ?>
            <form id="add-batch-item-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="Batchname">Batch Name:</label>
                <input type="text" id="Batchname" name="Batchname" required><br><br>

                <label for="startdate">Start date</label>
                <input type="date" id="startdate" name="startdate"><br><br>

                <label for="amountinvisted">Amount invested</label>
                <input type="number" id="amountinvisted" name="amountinvisted"><br><br>

                <label for="supplier">Supplier:</label>
                <input type="text" id="supplier" name="supplier"><br><br>

                <label for="supplier-phone">Supplier Phone:</label>
                <input type="text" id="supplier-phone" name="supplier-phone"><br><br>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity"><br><br>

                <label for="unit">Unit:</label>
                <select id="unit" name="unit">
                    <option value="kg">Kilograms</option>
                    <option value="g">Grams</option>
                </select><br><br>

                <label for="health-status">Health Status:</label>
                <input type="text" id="health-status" name="health-status"><br><br>

                <input type="submit" name="submit" value="Add">
            </form>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <button type="submit" name="show_details">Show Previous Batch Details</button>
            </form>
        </div>
    </section>

    <?php if (isset($_POST['show_details'])) : ?>
        <section id="batch-list">
            <div class="container">
                <h2>Batch List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Batch Name</th>
                            <th>Start Date</th>
                            <th>Amount Invested</th>
                            <th>Supplier</th>
                            <th>Supplier Phone</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Health Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0) : ?>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo $row["batch_name"]; ?></td>
                                    <td><?php echo $row["start_date"]; ?></td>
                                    <td><?php echo $row["amount_invested"]; ?></td>
                                    <td><?php echo $row["supplier"]; ?></td>
                                    <td><?php echo $row["supplier_phone"]; ?></td>
                                    <td><?php echo $row["quantity"]; ?></td>
                                    <td><?php echo $row["unit"]; ?></td>
                                    <td><?php echo $row["health_status"]; ?></td>
                                    <td><a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="9">No batches found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    <?php endif; ?>

    <footer>
        <p>&copy; 2024 Bhavani Hatchery. All rights reserved.</p>
    </footer>
</body>

</html>
