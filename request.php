<?php 
include('include/header.php');
include('database/connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Blood Request | Blood Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            margin-top: 5%;
           align:center;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            
        }
        
        h1 {
            color: #d32f2f;
            margin-bottom: 20px;
            text-align: center;
            font-size: 28px;
        }
        
        .form-header {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .form-col {
            flex: 1;
        }
        
        .required::after {
            content: "*";
            color: #d32f2f;
            margin-left: 4px;
        }
        
        .help-text {
            display: block;
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }
        
        .blood-type-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .blood-type-item {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
        }
        
        .blood-type-item label {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-bottom: 0;
        }
        
        .blood-type-item input {
            width: auto;
            margin-right: 8px;
        }
        
        .units-input {
            margin-top: 5px;
        }
        
        .submit-btn {
            background-color: #d32f2f;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 0 auto;
            min-width: 200px;
        }
        
        .submit-btn:hover {
            background-color: #b71c1c;
        }
        
        .emergency-note {
            background-color: #ffebee;
            border-left: 4px solid #d32f2f;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .total-quantity {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        
        @media (max-width: 600px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .blood-type-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hospital Blood Request</h1>
        
     
        
        <form id="hospital-blood-request-form">
            
            
            <div class="form-group">
                <label for="hospital-id" class="required">Hospital ID</label>
                <input type="text" name="hospital" id="hospital-id" placeholder="Hospital registration ID" required>
            </div>
            
            <div class="total-quantity">
                <div class="form-group">
                    <label for="total-blood-quantity" class="required">Total Quantity of Blood Required</label>
                    <div class="form-row">
                        <div class="form-col">
                            <input type="number" name="Blood-qnt" id="total-blood-quantity" min="1" placeholder="Enter total number of units" required>
                        </div>
                       
                    </div>
                    <span class="help-text">1 unit = approximately 450-500 ml of blood</span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="required">Blood Types Required</label>
                <span class="help-text">Select all required types and enter the number of units for each</span>
                
                <div class="blood-type-grid">
                    <div class="blood-type-item">
                        <label>
                            <input type="checkbox" name="blood_types" value="A+"> A+
                        </label>
                        <input type="number" placeholder="Units" min="0" class="units-input">
                    </div>
                    <div class="blood-type-item">
                        <label>
                            <input type="checkbox" name="blood_types" value="A-"> A-
                        </label>
                        <input type="number" placeholder="Units" min="0" class="units-input">
                    </div>
                    <div class="blood-type-item">
                        <label>
                            <input type="checkbox" name="blood_types" value="B+"> B+
                        </label>
                        <input type="number" placeholder="Units" min="0" class="units-input">
                    </div>
                    <div class="blood-type-item">
                        <label>
                            <input type="checkbox" name="blood_types" value="B-"> B-
                        </label>
                        <input type="number" placeholder="Units" min="0" class="units-input">
                    </div>
                    <div class="blood-type-item">
                        <label>
                            <input type="checkbox" name="blood_types" value="AB+"> AB+
                        </label>
                        <input type="number" placeholder="Units" min="0" class="units-input">
                    </div>
                    <div class="blood-type-item">
                        <label>
                            <input type="checkbox" name="blood_types" value="AB-"> AB-
                        </label>
                        <input type="number" placeholder="Units" min="0" class="units-input">
                    </div>
                    <div class="blood-type-item">
                        <label>
                            <input type="checkbox" name="blood_types" value="O+"> O+
                        </label>
                        <input type="number" placeholder="Units" min="0" class="units-input">
                    </div>
                    <div class="blood-type-item">
                        <label>
                            <input type="checkbox" name="blood_types" value="O-"> O-
                        </label>
                        <input type="number" placeholder="Units" min="0" class="units-input">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="date-needed" class="required">Date Needed</label>
                <input type="date" name="Date" id="date-needed" required>
            </div>
            
           
            
            <button type="submit" class="submit-btn">Submit Request</button>
        </form>
    </div>
</body>
</html>
<?php
// Database connection settings


// Fetch donors
$sql = "SELECT * FROM tb_H_Request";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); // Print the error details
}

$Requests = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $Requests[] = $row;
}

// Close the connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>
    <Style>
		/* styles.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 100rem;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

table {
    width: 1200px;
    border-collapse: collapse;
    margin-top: 20px;
	align-items: flex-end;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f1f1f1;
}
		</style>
</head>
<body>
    <div class="container">
        <h1>Requestst</h1>
        <table>
            <thead>
                <tr>
                    <th>Request_ID</th>
                    <th>Hospital Id</th>
                    <th>Blood Quantity</th>
					<th>Fulfilled DAte</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Requests as $Request): ?>
                    <tr>
                        <td><?php echo $Request['H_R_id']; ?></td>
                        <td><?php echo $Request ['H_id']; ?></td>
						<td><?php echo $Request['Requested_qnt']; ?></td>
						<td><?php echo $Request['H_R_BloodGrp']; ?></td>
						<td><?php echo $Request['Fulfilled_Date']; ?></td>
						
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $H_id = $_POST['hospital'];
    $Requested_qnt = $_POST['Blood-qnt'];
    $Fulfilled_Date= $_POST['Date'];

    // Prepare the SQL insert statement
    $sql = "INSERT INTO tb_H_Request (H_id, Requested_qnt, Fulfilled_Date) VALUES (?, ?, ?)";
    $params = array($H_id, $Requested_qnt, $Fulfilled_Date);

    // Execute the query
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Insert blood types and their quantities
    $H_R_BloodGrp = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    foreach ($H_R_BloodGrp as $bloodType) {
        if (isset($_POST['blood_types']) && in_array($bloodType, $_POST['blood_types'])) {
            $units = $_POST[$bloodType . '_units']; // Assuming you name the input fields as 'A+_units', etc.
            if ($units > 0) {
                $sql = "INSERT INTO tb_H_Request (H_id, H_R_Bloodgrp,) VALUES (?, ?)";
                $params = array($H_id, $H_R_BloodGrp,);
                $stmt = sqlsrv_query($conn, $sql, $params);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        }
    }

    // Close the statement and connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    echo "Request submitted successfully!";
}
?>

<?php
include('include/footer.php')
?>