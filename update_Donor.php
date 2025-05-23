<?php
// update_Donor.php

// Include database connection
include ('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $D_id = $_POST['D_id'];

    // Fetch current donor data
    $sql = "SELECT D_id,D_name, D_bloodtype,D_age,D_gender,D_identification,D_medical,D_contact,D_email,D_address,D_Last_Donation FROM tb_Donor WHERE D_id = ?";
    $params = array($D_id);
    $stmt = sqlsrv_query($conn, $sql, $params);
    $donor = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    

    // Check if donor exists
    if (!$donor) {
        echo "Donor not found.";
        exit;
    }

    // Display form for updating donor details
    ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Donor</title>
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
    <h1>Update Donor Information</h1>
    <form action="update_donor_process.php" method="post">
        <input type="hidden" name="D_id" value="<?= htmlspecialchars($donor['D_id']); ?>">
        Name: <input type="text" name="D_name" value="<?= htmlspecialchars($donor['D_name']); ?>"><br>
        Blood Type: <input type="text" name="D_bloodtype" value="<?= htmlspecialchars($donor['D_bloodtype']); ?>"><br>
        Age: <input type="number" name="D_age" value="<?= htmlspecialchars($donor['D_age']); ?>"><br><br>
        Gender: <input type="text" name="D_gender" value="<?= htmlspecialchars($donor['D_gender']); ?>"><br>
        Identification: <input type="text" name="D_identification" value="<?= htmlspecialchars($donor['D_identification']); ?>"><br>
        Medical History: <input type="text" name="D_medical" value="<?= htmlspecialchars($donor['D_medical']); ?>"><br>
        Contact: <input type="text" name="D_contact" value="<?= htmlspecialchars($donor['D_contact']); ?>"><br>
        Email: <input type="email" name="D_email" value="<?= htmlspecialchars($donor['D_email']); ?>"><br>
        Address: <input type="text" name="D_address" value="<?= htmlspecialchars($donor['D_address']); ?>"><br>
        Last Donation: <input type="text" name="D_Last_Donation" value="<?= htmlspecialchars($donor['D_Last_Donation']); ?>"><br>
        <input type="submit" value="Update Donor">
    </form>
</body>
</html>
    <?php
}
?>