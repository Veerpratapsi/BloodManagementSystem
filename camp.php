<?php	
	
	include ('include/header.php'); 
   include("database/connection.php")
?>

<style>
	.size{
		min-height: 0px;
		padding: 60px 0 40px 0;
		
	}
	.loader{
		display:none;
		width:69px;
		height:89px;
		position:absolute;
		top:25%;
		left:50%;
		padding:2px;
		z-index: 1;
	}
	.loader .fa{
		color: #e74c3c;
		font-size: 52px !important;
	}
	.form-group{
		text-align: left;
	}
	h1{
		color: white;
	}
	h3{
		color: #e74c3c;
		text-align: center;
	}
	.red-bar{
		width: 25%;
	}
	span{
		display: block;
	}
	.name{
		color: #e74c3c;
		font-size: 22px;
		font-weight: 700;
	}

	/* camp reg css*/

        .form-container {
            background-color: white;
            border: .5px solid #eee;
            border-radius: 5px;
            padding: 20px 10px 20px 30px;
            -webkit-box-shadow: 0px 2px 5px -2px rgba(89, 89, 89, 0.95);
            -moz-box-shadow: 0px 2px 5px -2px rgba(89, 89, 89, 0.95);
            box-shadow: 0px 2px 5px -2px rgba(89, 89, 89, 0.95);
            max-width: 600px;
            margin: auto; /* Center the form */
        }
        .form-group {
            text-align: left;
            margin-bottom: 15px; /* Space between form groups */
        }
        h1 {
            color: white;
            text-align: center;
        }
        h3 {
            color: #e74c3c;
            text-align: center;
        }
        .red-bar {
            width: 25%;
            height: 4px;
            background-color: #e74c3c;
            margin: 10px auto; /* Center the red bar */
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color:rgb(111, 7, 7);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; /* Full width for submit button */
        }
        input[type="submit"]:hover {
            background-color:rgb(87, 5, 13);
        }
</style>

    <div class="container-fluid red-background size">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<h1 class="text-center">Camps</h1>
				<hr class="white-bar">
			</div>
		</div>
	</div>


<div class="red-bar"></div>
<h3>Create a New Camp</h3>
<div class="form-container">
    <form action="/submit-camp" method="POST">
        <div class="form-group">
            <label for="campName">Camp Name:</label>
            <input type="text" id="campName" name="campName" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>

        <div class="form-group">
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required>
        </div>

        <div class="form-group">
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required>
        </div>

        <div class="form-group">
            <label for="contactPerson">Contact Person:</label>
            <input type="text" id="contactPerson" name="contactPerson" required>
        </div>

        <div class="form-group">
            <label for="doctor1">Doctor 1:</label>
            <input type="text" id="doctor1" name="doctor1" required>
        </div>

        <div class="form-group">
            <label for="doctor2">Doctor 2:</label>
            <input type="text" id="doctor2" name="doctor2">
        </div>

        <div class="form-group">
            <label for="helper1">Helper 1:</label>
            <input type="text" id="helper1" name="helper1" required>
        </div>

		<div class="form-group">
            <label for="helper2">Helper 2:</label>
            <input type="text" id="helper12" name="helper2" required>
        </div>

		<div class="form-group">
            <label for="helper3">Helper 3:</label>
            <input type="text" id="helper3" name="helper3" required>
        </div>

		<div class="form-group">
            <label for="helper4">Helper 4:</label>
            <input type="text" id="helper4" name="helper4" required>
        </div>

		<input type="submit" value="Create Camp">
		</form>
        <?php
// Database connection parameters

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $campName = $_POST['campName'];
    $address = $_POST['address'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $contactPerson = $_POST['contactPerson'];
    $doctor1 = $_POST['doctor1'];
    $doctor2 = $_POST['doctor2'];
    $helper1 = $_POST['helper1'];
    $helper2 = $_POST['helper2'];
    $helper3 = $_POST['helper3'];
    $helper4 = $_POST['helper4'];

    // Prepare the SQL insert statement
    $sql = "INSERT INTO Camps (CampName, Address, StartDate, EndDate, ContactPerson, Doctor1, Doctor2, Helper1, Helper2, Helper3, Helper4) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = sqlsrv_prepare($conn, $sql, array($campName, $address, $startDate, $endDate, $contactPerson, $doctor1, $doctor2, $helper1, $helper2, $helper3, $helper4));

    // Execute the statement
    if (sqlsrv_execute($stmt)) {
        echo "New camp created successfully!";
    } else {
        echo "Error: " . print_r(sqlsrv_errors(), true);
    }

    // Free statement and close connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>