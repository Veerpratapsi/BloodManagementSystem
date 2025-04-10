<?php
// Include database connection
include ('database/connection.php'); // Make sure to include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $H_id = $_POST['H_id'];

    // Fetch the current data for the hospital
    $sql = "SELECT H_id, H_name, H_contact, H_email, H_address, H_con_person FROM tb_Hospital WHERE H_id = ?";
    $params = array($H_id);
    $stmt = sqlsrv_query($conn, $sql, $params);
    $hospital = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    
    if (!$hospital) {
        die("Hospital not found.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Hospital Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
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
        }
    </style>
</head>
<body>

    <h1>Update Hospital Information</h1>
    <form action="update_hospital_process.php" method="post">
        <input type="hidden" name="H_id" value="<?php echo htmlspecialchars($hospital['H_id']); ?>">
        
        <label for="H_name">Hospital Name:</label>
        <input type="text" name="H_name" value="<?php echo htmlspecialchars($hospital['H_name']); ?>" required>
        
        <label for="H_contact">Contact Number:</label>
        <input type="text" name="H_contact" value="<?php echo htmlspecialchars($hospital['H_contact']); ?>" required>
        
        <label for="H_email">Email:</label>
        <input type="email" name="H_email" value="<?php echo htmlspecialchars($hospital['H_email']); ?>" required>
        
        <label for="H_address">Address:</label>
        <input type="text" name="H_address" value="<?php echo htmlspecialchars($hospital['H_address']); ?>" required>
        
        <label for="H_con_person">Contact Person:</label>
        <input type="text" name="H_con_person" value="<?php echo htmlspecialchars($hospital['H_con_person']); ?>" required>
        
        <input type="submit" value="Update Hospital">
    </form>

</body>
</html>