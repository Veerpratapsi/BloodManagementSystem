<?php 
  //include header file
  include ('include/header.php');
    include ('database/connection.php'); 
  if (isset($_POST['submit'])) {

	  if (isset($_POST['term']) === true) {

			//Name input check
		  if(isset($_POST['name']) && !empty($_POST['name'])){

				if (preg_match('/^[A-Za-z\s]+$/',$_POST['name'])) {

					$name = $_POST['name'];

				}else{
					$nameError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Please lower and upper case and space charecter are allow.</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
					</button>
				    </div>';
					}
		  }else{
			$nameError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Please fill the name field</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		  </div>';
		  }


		  //Gender Input check
		  if(isset($_POST['gender']) && !empty($_POST['gender'])){

			$gender = $_POST['gender'];
		  }else{
			$genderError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Please select your gender</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
		  }

		//Day Input
		  if(isset($_POST['day']) && !empty($_POST['day'])){
			$day = $_POST['day'];
		  }else{
			$dayError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Please select day</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
		  }


		  //month
		  if(isset($_POST['month']) && !empty($_POST['month'])){
			$month = $_POST['month'];
		  }else{
			$monthError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Please select month</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
		  }

		  //year
		  if(isset($_POST['year']) && !empty($_POST['year'])){
			$year = $_POST['year'];
		  }else{
			$yearError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Please select year</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
		  }

		  //blood group
		  if(isset($_POST['blood_group']) && !empty($_POST['blood_group'])){
			$blood_group = $_POST['blood_group'];
		  }else{
			$blood_groupError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Please select blood Group</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
		  }


		  //city
		  if(isset($_POST['city']) && !empty($_POST['city'])){

			if (preg_match('/^[A-Za-z\s]+$/',$_POST['city'])) {

					$city = $_POST['city'];

			}else{
				$cityError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Please lower and upper case and space charecter are allow.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
			}
		  }else{
			$cityError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Please fill the city field</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
		  }


		  if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){

			if (preg_match('/\d{10}/',$_POST['contact_no'])) {

				$contact = $_POST['contact_no'];
			}else{
				$contactError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>contact should consist of 10 charecters.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
			}
		  }else{
			$contactError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Please fill the contact field</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
		  }


//password
		  if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['c_password']) && !empty($_POST['c_password'])) {

				if (strlen($_POST['password'])>=6) {

						if ($_POST['password'] == $_POST['c_password']) {
							$password = $_POST['password']; 
						}else{
							$passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Password are not same.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  		    <span aria-hidden="true">&times;</span>
							</button>
			  				</div>';
						}
			
				}else{
					$passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>The password should consist of 6 character.</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  		<span aria-hidden="true">&times;</span>
					</button>
		  			</div>';
				}


	  	}else{
		  $passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Please fill password field.</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>';
	 	}


		 //mail check
	  if(isset($_POST['email']) && !empty($_POST['email'])){

				$pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/';

					if (preg_match($pattern,$_POST['email'])) {

						$check_email = $_POST['email'];

						$sql ="SELECT email FROM donor WHERE email='$check_email' ";

						$result = mysqli_query($connection,$sql);

						if (mysqli_num_rows($result)>0) {
						$emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Sorry this email already exist.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
						</button>
			 		    </div>';
						}else {
						$email = $_POST['email'];
						}


					}else{
						$emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Please enter valid email.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					}
	  }else{
				$emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Please fill the email field</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>';
	}

	//Inset Data
	  
	  if (isset($name) && isset($blood_group) && isset($gender) && isset($day) && isset($month) && isset($year) 
	  		&& isset($email) && isset($contact) && isset($city) && isset($password)) {

				$DonorDOB=$year."-".$month."-".$day;

				$password = md5($password);

				$sql = "INSERT INTO donor(name,gender,email,city,dob,contact_no,save_life_date,password,blood_group) 
				VALUES ('$name','$gender','$email','$city','$DonorDOB','$contact',0,'$password','$blood_group')";

		

				if(mysqli_query($connection, $sql)) {
				$submitSuccess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data inserted successfully.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
				}else {

				$submitError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data not inserted Try Again</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
				}
		}

	}
	  else{
		$termError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Please agree with our tearms and conditions.</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
	}


  }
?>*/

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
<div class="container-fluid red-background size">
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
        <label for="last_donation_date">Last Donation Date</label>
        <input type="date" name="D_Last_donation" id="last_donation_date" class="form-control" required value="<?php if (isset($D_Last_Donation)) echo $D_Last_Donation; ?>">
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