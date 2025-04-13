<?php

include('database/connection.php');

// Prepare and execute the SQL query
$sql = "SELECT H_R_id, h_id, Requested_qnt, H_R_BloodGrp, Fulfill_till, status  FROM tb_H_request";
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
    <title>Blood Requests</title>
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
            <h1>Blood Requests</h1>
            <table>
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Hospital ID</th>
                        <th>Requested Quantity</th>
                        <th>Blood Type</th>
                        <th>Fulfill Till</th>
                        <th>Status</th>
                        <th>Approve</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
<?php
    // Fetch and display data
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['H_R_id']) . "</td>"; // Request ID
        echo "<td>" . htmlspecialchars($row['h_id']) . "</td>"; // Hospital ID
        echo "<td>" . htmlspecialchars($row['Requested_qnt']) . "</td>"; // Requested Quantity
        echo "<td>" . htmlspecialchars($row['H_R_BloodGrp']) . "</td>"; // Blood Type
        
        // Display the Fulfill_till date
        if ($row['Fulfill_till'] instanceof DateTime) {
            echo "<td>" . htmlspecialchars($row['Fulfill_till']->format('Y-m-d')) . "</td>"; // Formatted date
        } else {
            echo "<td>" . htmlspecialchars($row['Fulfill_till']) . "</td>"; // Raw date
        }

        // Display the status
        echo "<td>" . htmlspecialchars($row['status']) . "</td>"; // Status

        // Approve button: only show if the status is not 'approved'
        if ($row['status'] !== 'approved') {
            echo "<td>
                    <form action='approve.php' method='POST'>
                        <input type='hidden' name='request_id' value='" . htmlspecialchars($row['H_R_id']) . "'>
                        <input type='submit' value='Approve' class='button'>
                    </form>
                  </td>";
        } else {
            echo "<td>Approved</td>"; // Indicate that the request is approved
        }
        if ($row['status'] !== 'approved') {
             echo"<td>
                     <form action='delete_request.php' method='post' style='display:inline;' >
                        <input type='hidden' name='H_R_id' value='" . htmlspecialchars($row['H_R_id']) . "'>
                       <input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this hospital?\");' class='button'>
                 </form>
              </td>";
         } else {
                echo "<td></td>"; // Indicate that the request is approved
            }
        echo "</tr>";
    }
?>
</tbody>
            </table>
        </div>
    </div>

</body>
</html>

<?php
// Free statement and close connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>