<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Inventory Management</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #2c2c2c; /* Dark background */
    color: #ffffff; /* White text for contrast */
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: auto;
    background: #3c3c3c; /* Slightly lighter background for the container */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    color:white;
}

header {
    text-align: center;
}

h1 {
    color: #b22222; /* Dark red color for the header */
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin: 10px 0 5px;
    color: #ffffff; /* White text for labels */
}

select{
       width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #b22222; /* Dark red border */
    border-radius: 4px;
    background-color: #4c4c4c; /* Darker input background */
    color: #ffffff; /* White text in inputs */
}

input[type="text"],
input[type="number"],
input[type="date"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #b22222; /* Dark red border */
    border-radius: 4px;
    background-color: #4c4c4c; /* Darker input background */
    color: #ffffff; /* White text in inputs */
}

button {
    background-color: #b22222; /* Dark red button */
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width:100%;
}

button:hover {
    background-color: #a52a2a; /* Slightly lighter red on hover */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #b22222; /* Dark red background for table headers */
    color: #ffffff; /* White text for headers */
}

tr:nth-child(even) {
    background-color: #4c4c4c; /* Darker background for even rows */
}

tr:hover {
    background-color: #5c5c5c; /* Slightly lighter on hover */
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
                <li><a href="inventory.php">Inventory</a></li>
               
            </ul>
        </aside>
    <div class="container">
        <header>
            <h1>Blood Bank Inventory Management</h1>
        </header>
        
        <main>
            <section>
                <h2>Add Blood Inventory</h2>
                <form id="addBloodForm" method="POST" action="">
                    <label for="bloodType">Blood Type:</label>
                    <select id="bloodtype" name="bloodtype" required>
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
                   
                    
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required>
                    
                    <label for="entryDate">Entry Date:</label>
                    <input type="date" id="entryDate" name="entryDate" required>
                    
                    <button type="submit">Add Blood</button>
                </form>
            </section>
            
        </main>
    </div>
</div>
</body>
</html>
<?php
include('database/connection.php');
// Handle form submission

    $bloodType = $_POST['bloodtype'];
    $quantity = $_POST['quantity'];
    $entryDate = $_POST['entryDate'];

    $sql = "INSERT INTO BloodInventory (BloodType, Quantity, EntryDate) VALUES (?, ?, ?)";
    $params = array($bloodType, $quantity, $entryDate);
    $sqlResult = sqlsrv_query($conn, $sql, $params);

    if ($sqlResult === false) {
        die(print_r(sqlsrv_errors(), true)); // Print error if query fails
    } else {
        echo "Blood inventory added successfully.";
    }



?>