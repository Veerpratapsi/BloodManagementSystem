<?php
//
// Include database connection
include ('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $BloodID = $_POST['BloodID'];

    // Fetch current donor data
    $sql = "SELECT  BloodID,BloodType, Quantity, EntryDate FROM BloodInventory WHERE BloodID = ?";
    $params = array($BloodID);
    $stmt = sqlsrv_query($conn, $sql, $params);
    $Blood = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    

    // Check if donor exists
    if (!$Blood) {
        echo "Collection not found.";
        exit;
    }

    // Display form for updating donor details
    ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
       body {
    background-color: white; /* Dark background for the body */
    color: black; /* White text color for contrast */
    font-family: Arial, sans-serif; /* Font style */
}

h1 {
            text-align: center;
            color: #c0392b; /* Blood red color */
        }

form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #c0392b; /* Blood red color */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #a93226; /* Darker red on hover */
        }

        @media (max-width: 600px) {
            form {
                padding: 15px;
            }

            input[type="submit"] {
                font-size: 14px;
            }
        }    </style>
</head>
<body>
<div class="container">
        <h1>Update Blood Inventory</h1>
        <form action="update_inventory_process.php" method="POST">
            <input type="hidden" name="bloodId" value="<?php echo htmlspecialchars($Blood['BloodID']); ?>">
            <div class="form-group">
                <label for="bloodType">Blood Type:</label>
                <input type="text" id="bloodType" name="bloodType" value="<?php echo htmlspecialchars($Blood['BloodType']); ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($Blood['Quantity']); ?>" required>
            </div>
            <div class="form-group">
                <label for="entryDate">Entry Date:</label>
                <input type="date" id="entryDate" name="entryDate" value="<?php echo htmlspecialchars($Blood['EntryDate']->format('Y-m-d')); ?>" required>
            </div>
           <br>
           <input type="submit" value="Update Inventory">
        </form>
    </div>

</body>
</html>
<?php
}
?>