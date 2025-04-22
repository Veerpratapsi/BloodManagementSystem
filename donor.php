<?php
include('include/header.php'); 
include('database/connection.php'); 

// Fetch donors
$sql = "SELECT * FROM tb_Donor";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$donors = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $donors[] = $row;
}

sqlsrv_free_stmt($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donors List</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            width: auto;
        }

        .parent{
            display: flex;
            flex-direction: column;
        }
        .containerm{
            margin-left: 17rem;
            padding: 20px;
            width: 80rem;
            overflow: scroll;
            scrollbar-width: hidden;
        }

        .sidebar {
            width: 16rem;
            height: 100vh;
            background-color: darkred;
            color: white;
            padding: 2rem;
            position: fixed;
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

        .sidebar ul li a:hover {
            background-color: #a30000;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 1rem;
        }

        table {
            border-collapse: collapse;
        }

        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
    background-color: darkred;
    color: white;
    padding: 1rem;
}


        tr:hover {
            background-color: #f1f1f1;
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
            <h2>Blood Management</h2>
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

        <div class="containerm">
            <h1>Donors List</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Bloodtype</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Identification</th>
                        <th>Medical History</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Last Donation</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donors as $donor): ?>
                        <tr>
                            <td><?= $donor['D_id']; ?></td>
                            <td><?= $donor['D_name']; ?></td>
                            <td><?= $donor['D_bloodtype']; ?></td>
                            <td><?= $donor['D_age']; ?></td>
                            <td><?= $donor['D_gender']; ?></td>
                            <td><?= $donor['D_identification']; ?></td>
                            <td><?= $donor['D_medical']; ?></td>
                            <td><?= $donor['D_contact']; ?></td>
                            <td><?= $donor['D_email']; ?></td>
                            <td><?= $donor['D_address']; ?></td>
                            <td><?= $donor['D_Last_Donation']; ?></td>
                            <td>
    <form action='update_Donor.php' method='post' style='display:inline;'>
        <input type='hidden' name='D_id' value='<?= htmlspecialchars($donor['D_id']); ?>'>
        <input type='submit' value='Update' class='button'>
    </form>
</td>
<td>
    <form action='delete_Donor.php' method='post' style='display:inline;'>
        <input type='hidden' name='D_id' value='<?= htmlspecialchars($donor['D_id']); ?>'>
        <input type='submit' value='Delete' onclick='return confirm("Are you sure you want to delete this donor?");'class='button'>
    </form>
</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php include('include/footer.php'); ?>
