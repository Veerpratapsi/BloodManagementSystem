<?php
include('database/connection.php');
$sql = "SELECT hospital_id, hospital_name, contact_number, email, address, contact_person FROM Hospitals";
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
            background: #3c3c3c; /* Slightly lighter background for the container */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color:white;
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

tr:nth-child(even) {
    background-color: #4c4c4c; /* Darker background for even rows */
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
    </style>
    <title>Registered Hospitals</title>
</head>
<body>
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
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
    <?php
    // SQL query to select data
    $sql = "SELECT H_id, H_name, H_contact, H_email, H_address, H_con_person FROM tb_Hospital";
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
</body>
</html>