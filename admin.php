<?php
// Database connection parameters
include('database/connection.php');

// Queries to fetch data
$totalDonorsQuery = "SELECT COUNT(*) AS TotalDonors FROM tb_Donor";
$totalRequestsQuery = "SELECT COUNT(*) AS TotalRequests FROM tb_h_Request";
$availableBloodQuery = "SELECT SUM(Quantity) AS AvailableBlood FROM BloodInventory";
$pendingRequestsQuery = "SELECT COUNT(*) AS PendingRequests FROM tb_h_Requests WHERE Status = 'Pending'";

// Execute queries and fetch results
$totalDonorsResult = sqlsrv_query($conn, $totalDonorsQuery);
$totalRequestsResult = sqlsrv_query($conn, $totalRequestsQuery);
$availableBloodResult = sqlsrv_query($conn, $availableBloodQuery);
$pendingRequestsResult = sqlsrv_query($conn, $pendingRequestsQuery);

// Fetching data
$totalDonors = sqlsrv_fetch_array($totalDonorsResult, SQLSRV_FETCH_ASSOC)['TotalDonors'];
$totalRequests = sqlsrv_fetch_array($totalRequestsResult, SQLSRV_FETCH_ASSOC)['TotalRequests'];
/*$availableBlood = sqlsrv_fetch_array($availableBloodResult, SQLSRV_FETCH_ASSOC)['AvailableBlood'];
$pendingRequests = sqlsrv_fetch_array($pendingRequestsResult, SQLSRV_FETCH_ASSOC)['PendingRequests'];*/

// Close the connection
sqlsrv_close($conn);
?>

<!-- Displaying the results in the HTML -->
<script>
    document.getElementById('total-donors').innerText = "<?php echo $totalDonors; ?>";
    document.getElementById('total-requests').innerText = "<?php echo $totalRequests; ?>";
   /* document.getElementById('available-blood').innerText = "<?php echo $availableBlood; ?>";
    document.getElementById('pending-requests').innerText = "<?php echo $pendingRequests; ?>";/*
</script>

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
    display: flex;
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
              
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="register_donor.php">Register Donors</a></li>
                <li><a href="hospital_registration.php">Register Hospital</a></li>
                <li><a href="show_requests.php">Requests</a></li>
                <li><a href="Donor.php">Donor Details</a></li>
                <li><a href="Show_Hospital.php">Hospitals</a></li>
                

               
            </ul>
        </aside>
        <main class="main-content">
            <header>
                <h1>Admin Dashboard</h1>
                <div class="user-info">
                    <span>Welcome, Admin</span>
                    <button id="logout">Logout</button>
                </div>
            </header>
            <section class="stats">
                <div class="stat-card">
                    <h3>Total Donors</h3>
                    <p id="total-donors"><?php echo $totalDonors; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Requests</h3>
                    <p id="total-requests"><?php echo $totalRequests; ?></p>
                </div>
                <!--
                <div class="stat-card">
                    <h3>Available Blood Units</h3>
                    <p id="available-blood"><?php echo $availableBlood; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Pending Requests</h3>
                    <p id="pending-requests"><?php echo $pendingRequests; ?></p>
                </div>-->
            </section>
        </main>
    </div>
    
</body>
<script>
    document.getElementById('logout').addEventListener('click', function() {
        // Redirect to the logout script
        window.location.href = 'index.php';
    });
</script>
</html>
