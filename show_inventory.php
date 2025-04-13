<?php
include('database/connection.php');

// Prepare and execute the SQL query
$sql = "SELECT BloodID,BloodType,Quantity,EntryDate,status  FROM BloodInventory";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); // Error handling
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Collection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
       
            border-radius: 8px;
         
            color:black;
        }

        h1 {
            text-align: center;
            color: #a00000;
        }

        table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #b22222; /* Dark red background for table headers */
    color: #ffffff; /* White text for headers */
}



tr:hover {
    background-color: #5c5c5c; /* Slightly lighter on hover */
}
 
 
   
   

.sidebar {
    width: 250px;
    height: 775px;
    background-color:darkred;
    color: white;
    padding: 20px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    margin: 15px 0;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    padding: 10px;
    display: block;
    border-radius: 5px;
}

.sidebar ul li a:hover,
.sidebar ul li a.active {
    background-color: darkred;
}
.parent{
            display: flex;
            align-items: center;
        }

        .button {
    background-color: #8B0000; /* Dark red color */
    color: white; /* Text color */
    border: none; /* No border */
    border-radius: 25px; /* Curved corners */
    padding: 10px 20px; /* Padding for size */
    font-size: 16px; /* Font size */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

.button:hover {
    background-color: #A52A2A; /* Lighter red on hover */
}

    </style>
</head>
<body>
    <div class="parent">
        <aside class="sidebar">
            <h2>Blood Management System</h2>
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="register_donor.php">Register Donors</a></li>
                <li><a href="hospital_registration.php">Register Hospital</a></li>
                <li><a href="show_requests.php">Requests</a></li>
                <li><a href="Donor.php">Donor Details</a></li>
                <li><a href="Show_Hospital.php">Hospitals</a></li>
                <li><a href="inventory.php">Inventory Insert</a></li>
                <li><a href="show_inventory.php">Inventory</a></li>
            </ul>
        </aside>
        <div class="container">
            <h1>Blood Inventory</h1>
            <table>
                <thead>
                    <tr>
                        <th>Blood ID</th>
                        <th>Blood Type</th>
                        <th>Blood  Quantity</th>
                        <th>Entry Date</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
<?php
    // Fetch and display data
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['BloodID']) . "</td>"; // blood ID
        echo "<td>" . htmlspecialchars($row['BloodType']) . "</td>"; // blood type
        echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>"; // available quantity
        
        // Display the Fulfill_till date
        if ($row['EntryDate'] instanceof DateTime) {
            echo "<td>" . htmlspecialchars($row['EntryDate']->format('Y-m-d')) . "</td>"; // Formatted date
        } else {
            echo "<td>" . htmlspecialchars($row['EntryDate']) . "</td>"; // Raw date
        }

        // Display the status
        echo "<td>" . htmlspecialchars($row['status']) . "</td>"; // Status

        echo" <td>
        <form action='update_inventory.php' method='post' style='display:inline;'>
            <input type='hidden' name='BloodID' value='" . htmlspecialchars($row['BloodID']) . "'>
          <input type='submit' value='Update' class='button'>
        </form>
    </td>";

       echo" <td>
        <form action='delete_inventory.php' method='post' style='display:inline;'>
            <input type='hidden' name='BloodID' value='" . htmlspecialchars($row['BloodID']) . "'>
            <input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this hospital?\");' class='button'>
        </form>
    </td>";

   
        echo "</tr>";
    }
?>
</tbody>
            </table>
        </div>
    </div>

</body>
</html>