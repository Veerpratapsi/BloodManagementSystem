<?php	
	
	include ('include/header.php'); 
    include ('database/connection.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		
	.size{
		min-height: 0px;
		padding: 60px 0 40px 0;
		
	}
	.form-container{
		background-color: white;
		border: .5px solid #eee;
		border-radius: 5px;
		padding: 20px 10px 20px 30px;
		-webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
-moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
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
</style>
	</style>
</head>
<body>

<div class="container size">
	<div class="row">
		<div class="col-md-6 offset-md-3 form-container">
					<h3>Register Donor</h3>
					
					<hr class="red-bar">
					<?php
					if (isset($termError)) echo $termError;

					if (isset($submitSuccess))	echo $submitSuccess;

					if (isset($submitError))	echo $submitError;

					?>
					
          <!-- Error Messages -->

		  <form class="form-group" action="" method="post" novalidate="">
    <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" name="D_name" id="fullname" placeholder="Full Name" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" class="form-control" value="<?php if (isset($D_name)) echo $D_name; ?>">
        <?php if (isset($D_nameError)) echo $D_nameError; ?>
    </div><!--full name-->

    <div class="form-group">
        <label for="blood_group">Blood Type</label>
        <select class="form-control demo-default" id="blood_group" name="D_bloodtype" required>
            <option value="">---Select Your Blood Type---</option>
            <?php if (isset($blood_group)) echo '<option selected="" value="' . $D_bloodtype . '">' . $D_bloodtype . '</option>'; ?>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>
        <?php if (isset($D_bloodtypeError)) echo $D_bloodtypeError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <label for="age">Age</label>
        <input type="number" name="D_age" id="age" placeholder="Age" required min="1" max="120" class="form-control" value="<?php if (isset($D_age)) echo $D_age; ?>">
        <?php if (isset($D_ageError)) echo $D_ageError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <label for="gender">Gender</label><br>
        <label><input type="radio" name="D_gender" value="Male" required <?php if (isset($D_gender) && $D_gender == "Male") echo 'checked'; ?>> Male</label>
        <label><input type="radio" name="D_gender" value="Female" required <?php if (isset($D_gender) && $D_gender == "Female") echo 'checked'; ?>> Female</label>
        <label><input type="radio" name="D_gender" value="Other" required <?php if (isset($D_gender) && $D_gender == "Other") echo 'checked'; ?>> Other</label>
        <?php if (isset($D_genderError)) echo $D_genderError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <label for="id_proof">ID Proof</label>
        <input type="number" name="D_identification" id="id_proof" class="form-control" required>
        <?php if (isset($D_identificationError)) echo $D_identificationError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <label for="med_history">Medical History</label>
        <textarea name="D_medical" id="med_history" placeholder="Your Medical History" class="form-control"><?php if (isset($D_medical)) echo $D_medical; ?></textarea>
        <?php if (isset($D_medicalError)) echo $D_medicalError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <label for="contact_no">Contact No</label>
        <input type="text" name="D_contact" placeholder="03********" class="form-control" required pattern="^\d{10}$" title="10 numeric characters only" maxlength="10" value="<?php if (isset($D_contact)) echo $D_contact; ?>">
        <?php if (isset($D_contactError)) echo $D_contactError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="D_email" id="email" placeholder="Email" required class="form-control" value="<?php if (isset($D_email)) echo $D_email; ?>">
        <?php if (isset($D_emailError)) echo $D_emailError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="D_address" id="address" placeholder="Your Address" required class="form-control"><?php if (isset($address)) echo $address; ?></textarea>
        <?php if (isset($D_addressError)) echo $D_addressError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <label for="last_donation_date">Last Donation Date</label>
        <input type="date" name="D_Last_Donation" id="last_donation_date" class="form-control" required value="<?php if (isset($D_Last_Donation)) echo $D_Last_Donation; ?>">
        <?php if (isset($D_Last_DonationError)) echo $D_Last_DonationError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div><!--End form-group-->
</form>
		</div>
	</div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Management System - Admin Dashboard</title>
    <style>
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    margin-left: 20%;
}

.sidebar {
    width: 250px;
    height: 775px;
    background-color:darkred;
    color: white;
    padding: 20px;
	display:flexbox;
	position:fixed;
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

.main-content {
    flex: 1;
    padding: 20px;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.stat-card {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.stat-card h3 {
    margin-bottom: 10px;
}

.user-info {
    display: flex;
    align-items: center;
}

#logout {
    margin-left: 20px;
    padding: 5px 10px;
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#logout:hover {
    background-color: #c0392b;
}
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Blood Management System</h2>
            <ul>
              
                <li><a href="donor.php">Donors</a></li>
                <li><a href="request.php">Requests</a></li>
                
            
            </ul>
        </aside>
		</html>
		<?php
// Database connection settings


// Fetch donors
$sql = "SELECT * FROM tb_Donor";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); // Print the error details
}

$donors = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $donors[] = $row;
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
    <title>Donors List</title>
    <Style>
		/* styles.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
	margin-left:15%;
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donors as $donor): ?>
                    <tr>
                        <td><?php echo $donor['D_id']; ?></td>
                        <td><?php echo $donor['D_name']; ?></td>
						<td><?php echo $donor['D_bloodtype']; ?></td>
						<td><?php echo $donor['D_age']; ?></td>
						<td><?php echo $donor['D_gender']; ?></td>
						<td><?php echo $donor['D_identification']; ?></td>
						<td><?php echo $donor['D_medical']; ?></td>
						<td><?php echo $donor['D_contact']; ?></td>
                        <td><?php echo $donor['D_email']; ?></td>
						<td><?php echo $donor['D_address']; ?></td>
						<td><?php echo isset($donor['D_Last_Donation']) ? $donor['D_Last_Donation'] : 'N/A'; ?></td>
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
    // Get form data
    $D_name = $_POST['D_name'];
    $D_bloodtype = $_POST['D_bloodtype'];
	$D_age=$_POST['D_age'];
	$D_gender=$_POST['D_gender'];
	$D_identification= $_POST['D_identification'];
	$D_medical = $_POST['D_medical'];
	$D_contact = $_POST['D_contact'];
	$D_email = $_POST['D_email'];
    $D_address = $_POST['D_address'];
    $D_Last_Donation = $_POST['D_Last_Donation'];


    // Prepare the SQL statement
    $sql = "INSERT INTO tb_donor (D_name, D_bloodtype,D_age,D_gender,D_identification,D_medical,D_contact,D_email,D_address,D_Last_Donation) 
            VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?)";
    
    $params = array($D_name, $D_bloodtype,$D_age,$D_gender,$D_identification,$D_medical,$D_contact,$D_email,$D_address,$D_Last_Donation);

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

	include ('include/footer.php'); 
	

?>