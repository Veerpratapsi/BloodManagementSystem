<?php
include('database/connection.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Login</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.login-container {
    width: 300px;
    margin: 100px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
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


.error-message {
    color: red;
    text-align: center;
    margin-top: 10px;
}
    </style>

</head>
<body>
    <div class="login-container">
        <h2>Hospital Login</h2>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
<script>
    document.getElementById('logout').addEventListener('click', function() {
        // Redirect to the logout script
        window.location.href = 'index.php';
    });
</script>
</html>

<?php
// login.php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare and execute the SQL statement
    $sql = "SELECT * FROM tb_hospital WHERE h_email = ? AND password = ?";
    $params = array($email, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the user
    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        // Password is correct, set session variables
        $_SESSION['login_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        header("Location:request.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "Invalid username or password.";
    }

    // Free statement and connection resources
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>