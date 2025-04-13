<?php 
  //include header file
  include ('include/header.php');
    include ('database/connection.php'); 
?>

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

</style>

<div class="container-fluid red-background size">
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
	</div>
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<h1 class="text-center">Donate</h1>
			<hr class="white-bar">
		</div>
	</div>
</div>

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
        <input type="text" name="D_identification" id="id_proof" class="form-control" required>
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
        <label for="last_donation_month">Last Donation </label>
        <input type="text" name="D_Last_Donation" id="last_donation_month" class="form-control" required value="<?php if (isset($D_Last_Donation)) echo $D_Last_Donation; ?>">
        <?php if (isset($D_Last_DonationError)) echo $D_Last_DonationError; ?>
    </div><!--End form-group-->

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div><!--End form-group-->
</form>
		</div>
	</div>
</div>
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
  //include footer file
  include ('include/footer.php');
?>