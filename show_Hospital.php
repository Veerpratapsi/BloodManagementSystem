<?php

include('database/connection.php');
$sql = "SELECT hospital_id, hospital_name, contact_number, email, address, contact_person,password FROM Hospitals";
$stmt = sqlsrv_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard</title>
    <style>

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
    </style>
    <title>Registered Hospitals</title>
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
        <h1>Registered Hospitals</h1>
        <table>
            <thead>
                <tr>
                    <th>Hospital ID</th>
                    <th>Hospital Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Contact Person</th>
                    <th>Password</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
    <?php
    // SQL query to select data
    $sql = "SELECT H_id, H_name, H_contact, H_email, H_address, H_con_person,password FROM tb_Hospital";
    $stmt = sqlsrv_query($conn, $sql);

    // Check if the query was successful
    if ($stmt === false) {
        die("Query failed: " . print_r(sqlsrv_errors(), true));
    }

    // Fetch and display the data
    $hasRows = false; // Flag to check if there are rows
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $hasRows = true; // Set flag to true if we fetch at least one row
        echo "<tr>
                <td>" . htmlspecialchars($row['H_id']) . "</td>
                <td>" . htmlspecialchars($row['H_name']) . "</td>
                <td>" . htmlspecialchars($row['H_contact']) . "</td>
                <td>" . htmlspecialchars($row['H_email']) . "</td>
                <td>" . htmlspecialchars($row['H_address']) . "</td>
                <td>" . htmlspecialchars($row['H_con_person']) . "</td>
                       <td>" . htmlspecialchars($row['password']) . "</td>
                <td>
                    <form action='update_hospital.php' method='post' style='display:inline;' >
                        <input type='hidden' name='H_id' value='" . htmlspecialchars($row['H_id']) . "'>
                        <input type='submit' value='Update' class='button'>
                    </form>
                </td>
                <td>
                    <form action='delete_hospital.php' method='post' style='display:inline;'>
                        <input type='hidden' name='H_id' value='" . htmlspecialchars($row['H_id']) . "'>
                        <input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this hospital?\");' class='button'>
                    </form>
                </td>
              </tr>";
    }

    // If no rows were found, display a message
    if (!$hasRows) {
        echo "<tr><td colspan='7'>No registrations found.</td></tr>";
    }

    // Free statement and connection resources
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    ?>
</tbody>
        </table>
    </div>
</div>
</body>
</html>