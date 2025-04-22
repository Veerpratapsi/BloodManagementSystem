<?php 

	//include header file
	include ('include/header.php');
    include('database/connection.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Registration Form</title>
    <Style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f5dc; /* Cream background */
    margin: 0;
    padding: 20px;
}

     h1 {
            text-align: center;
            color: #c0392b; /* Blood red color */
            margin-top: 50px;
        }
form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin:  auto;
       
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
</head>
<body>
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
    <div class="container">
        <h1>Hospital Registration Form</h1>
        <form action="hospital_registration.php" method="POST">
            <label for="hospital_name">Hospital Name:</label>
            <input type="text" id="H_name" name="hospital_name" placeholder="Enter Hospital Name" required>

            <label for="contact_number">Contact Number:</label>
            <input type="tel" id="H_contact" name="contact_number" placeholder="Enter Contact Number" required pattern="[0-9]{10}">
        
            <label for="email">Email Address:</label>
            <input type="email" id="H_email" name="email" placeholder="Enter Email Address" required>

            <label for="password">Password:</label>
            <input type="password" id="passwordl" name="password" placeholder="password" required>

            <label for="address">Address:</label>
            <textarea id="H_address" name="address" placeholder="Enter Hospital Address" required></textarea>

            <label for="contact_person">Contact Person:</label>
            <input type="text" id="H_con_person" name="contact_person" placeholder="Enter Contact Person's Name" required>

            <button type="submit">Register Hospital</button>
            <button type="reset">Clear Form</button>
        </form>
    </div>
</div>
</body>
</html>

<?php


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Taking all values from the form data
    $H_name = $_POST['hospital_name'];
    $H_contact = $_POST['contact_number'];
    $H_email = $_POST['email'];
    $H_address = $_POST['address'];
    $H_con_person = $_POST['contact_person'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $sql = "INSERT INTO tb_Hospital (H_name, H_contact, H_email, H_address, H_con_person,password) 
            VALUES (?, ?, ?, ?, ?,?)";

    // Prepare the statement
    $params = array($H_name, $H_contact, $H_email, $H_address, $H_con_person,$password);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    // Execute the statement
    if ($stmt && sqlsrv_execute($stmt)) {
        echo "Data stored in the database successfully.";
        // Optionally, redirect to another page after successful registration
        // header("Location: success_page.php");
        // exit();
    } else {
        echo "Error in inserting data: " . print_r(sqlsrv_errors(), true);
    }

    // Free the statement and close the connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>