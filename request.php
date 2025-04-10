<?php 
include('include/header.php');
include('database/connection.php')

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Request Form</title>
    <Style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f5dc; /* Cream background */
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 600px;
    margin: auto;
    background: #8B0000; /* Dark red background */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    color:black; /* White text for contrast */
    margin-top: 4pc;
}

h1 {
    text-align: center;
    color: #fff; /* White text for the heading */
}

label {
    display: block;
    margin: 10px 0 5px;
    color: #f5f5dc; /* Cream color for labels */
}

input[type="text"],
input[type="tel"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #f5f5dc; /* Cream border */
    border-radius: 4px;
    background-color: #fff; /* White background for inputs */
    color: #333; /* Dark text for inputs */
}

textarea {
    resize: vertical; /* Allow vertical resizing */
}

button {
    background-color: #c72c2c; /* Lighter dark red for buttons */
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 10px; /* Space between buttons */
}

button[type="reset"] {
    background-color: #f44336; /* Red for reset button */
}

button:hover {
    opacity: 0.8;
}

button[type="reset"]:hover {
    background-color: #d32f2f; /* Darker red on hover for reset */
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Blood Request Form</h1>
        <form action="" method="POST">

            <label for="hospital_id">Hospital ID:</label>
            <select name="H_id" id="H_id" required>
                <option value="" >Select Hospital</option>
                <?php
                // Fetch hospital data
                $sql = "SELECT H_id FROM tb_Hospital";
                $stmt = sqlsrv_query($conn, $sql);
                
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    echo "<option value=" . $row['H_id'] . "></option>";
                }

                sqlsrv_free_stmt($stmt);
                ?>
            </select>


            <label for="Requested_qnt">Requested Quantity (in units):</label>
            <input type="number" id="Requested_qnt" name="Requested_qnt" min="1" required>


            <label for="Blood_Type">Blood Type</label>
            <select id="H_R_BloodGrp" name="H_R_BloodGrp" required>
                <option value="">Select Blood Type</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>


            <label for="fulfill_till">Fulfill til:</label>
            <input type="date" id="Fulfill_till" name="Fulfill_till" required>


<br>
<br>
            <button type="submit">Request</button>
            <button type="reset">Clear Form</button>
        </form>
    </div>
</body>
</html>

<?php
// Database connection parameters


// Taking all values from the form data

$H_id = $_POST['H_id'];
$Requested_qnt = $_POST['Requested_qnt'];
$H_R_BloodGrp = $_POST['H_R_BloodGrp'];
$Fulfill_till= $_POST['Fulfill_till'];


// Prepare the SQL statement
$sql = "INSERT INTO tb_H_request (H_id,Requested_qnt,H_R_BloodGrp,Fulfill_till) 
        VALUES (?, ?, ?, ?)";

// Prepare the statement
$params = array($H_id,$Requested_qnt,$H_R_BloodGrp,$Fulfill_till) ;
$stmt = sqlsrv_prepare($conn, $sql, $params);

// Execute the statement
if (sqlsrv_execute($stmt)) {
    echo "Data stored in the database successfully.";
} else {
    echo "Error in inserting data: " . print_r(sqlsrv_errors(), true);
}

// Close the connection

?><?php
include('include/footer.php')
?>