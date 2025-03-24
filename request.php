<?php 
include('include/header.php')


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
                            <input type="number" id="total-blood-quantity" min="1" placeholder="Enter total number of units" required>
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
                <input type="date" id="date-needed" required>
            </div>
            
           
            
            <button type="submit" class="submit-btn">Submit Request</button>
        </form>
    </div>
</body>
</html>
<?php
$serverName = "VEERPRATAP\SQLEXPRESS";
$database="Blood_Management_System";
$uid="";
$pass="";

$Connection=[
    "Database" => $database,
    "UID" =>$uid,
    "PWD" =>$pass
];

$conn= sqlsrv_connect($serverName,$Connection);

if (!$conn) 
    die(print_r(sqlsrv_errors(), true));


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
 
    $H_id = $_POST['hospital-id'];
	$Requested_qnt=$_POST['total-blood-quantity'];
	$H_R_BloodGrp=$_POST['blood_types'];
    $Fulfilled_Date=$_POST['date-needed'];


    // Prepare the SQL statement
    $sql = "INSERT INTO tb_donor (H_id, Requested_qnt,H_R_BloodGrp,Fulfilled_Date) 
            VALUES (?, ?, ?, ?)";
    
    $params = array($H_id, $Requested_qnt,$H_R_BloodGrp,$Fulfilled_Date);

    // Execute the statement
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo "Error in executing query.<br />";
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "New record created successfully";
    }

    // Free statement and connection resources
    sqlsrv_free_stmt($stmt);
}

// Close the connection
sqlsrv_close($conn);
?>

<?php
include('include/footer.php')
?>