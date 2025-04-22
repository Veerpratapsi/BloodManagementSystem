<?php
// Database connection parameters
include('database/connection.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Management System - Hospital Dashboard</title>
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
              
                <li><a href="request.php">Request Blood</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header>
                <h1>Hospital Dashboard</h1>
                <div class="user-info">
                    <span>Welcome,</span>
                    <button id="logout">Logout</button>
                </div>
            </header>
    </div>
</main>
</body>
<script>
    document.getElementById('logout').addEventListener('click', function() {
        // Redirect to the logout script
        window.location.href = 'index.php';
    });
</script>
</html>
