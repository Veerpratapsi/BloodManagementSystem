<?php 
include('database/connection.php');

?>
<!-- login.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; /* Light background for contrast */
            display:flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            margin: 0;
        }

        form {
            background-color: #ffffff; /* White background for the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            padding: 20px; /* Padding inside the form */
            width: 300px; /* Fixed width for the form */
        }

        h2 {
            text-align: center; /* Center the heading */
            color: #c0392b; /* Blood red color for the heading */
        }

        label {
            display: block; /* Block display for labels */
            margin-bottom: 5px; /* Space between label and input */
            color: #333; /* Dark text color */
        }

        input[type="text"],
        input[type="password"] {
            width: 100%; /* Full width inputs */
            padding: 10px; /* Padding inside inputs */
            margin-bottom: 15px; /* Space below inputs */
            border: 1px solid #ccc; /* Light border */
            border-radius: 4px; /* Rounded corners for inputs */
            box-sizing: border-box; /* Include padding in width */
        }

        input[type="checkbox"] {
            margin-right: 5px; /* Space between checkbox and label */
        }

        input[type="submit"] {
            background-color: #c0392b; /* Blood red background for the button */
            color: white; /* White text color */
            border: none; /* No border */
            border-radius: 4px; /* Rounded corners for button */
            padding: 10px; /* Padding inside button */
            cursor: pointer; /* Pointer cursor on hover */
            width: 100%; /* Full width button */
            font-size: 16px; /* Larger font size */
        }

        input[type="submit"]:hover {
            background-color: #a93226; /* Darker red on hover */
        }
    </style>
</head>
<body>

    <form action="login.php" method="POST">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required placeholder="Enter your username">
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password">
        
        <input type="submit" value="Login">
    </form>

</body>
</html>
</html>

<?php
// login.php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare and execute the SQL statement
    $sql = "SELECT * FROM admins WHERE username = ? AND password = ?";
    $params = array($username, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the user
    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        // Password is correct, set session variables
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_username'] = $row['username'];
        header("Location: admin.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "Invalid username or password.";
    }

    // Free statement and connection resources
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>