
<?php 

include('database/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Taking all values from the form data
    $H_id = $_POST['H_id'];
    $Requested_qnt = $_POST['Requested_qnt'];
    $H_R_BloodGrp = $_POST['H_R_BloodGrp'];
    $Fulfill_till = $_POST['Fulfill_till'];

    // Prepare the SQL statement
    $sql = "INSERT INTO tb_H_request (H_id, Requested_qnt, H_R_BloodGrp, Fulfill_till) 
            VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $params = array($H_id, $Requested_qnt, $H_R_BloodGrp, $Fulfill_till);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    // Execute the statement
    if (sqlsrv_execute($stmt)) {
        // Redirect to the same page to prevent resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Ensure no further code is executed
    } else {
        echo "Error in inserting data: " . print_r(sqlsrv_errors(), true);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Request Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc; /* Cream background */
            /*border:0px;*/
        }

        .container { 
            margin: auto;
            background:white; /* Dark red background */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: black; /* Black text for contrast */
            margin-top: 4pc;
            display: flex;
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
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
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
            <div class="container">
                <h1>Blood Request Form</h1>
                <form action="" method="POST">
                    <label for="H_id">Hospital ID:</label>
                    <select name="H_id" id="H_id" required>
                      <option value="">Select Hospital</option>
                        <?php
                        // Fetch hospital data
                        $sql = "SELECT H_id FROM tb_Hospital";
                        $stmt = sqlsrv_query($conn, $sql);
    
                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            echo "<option value='" . $row['H_id'] . "'>" . $row['H_id'] . "</option>";
                        }

                        sqlsrv_free_stmt($stmt);
                        ?>
                    </select>

                    <label for="Requested_qnt">Requested Quantity (in units):</label>
                    <input type="number" id="Requested_qnt" name="Requested_qnt" min="1" required>

                    <label for="H_R_BloodGrp">Blood Type:</label>
                    <select id="H_R_BloodGrp" name="H_R_BloodGrp" required>
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

                    <label for="Fulfill_till">Fulfill till:</label>
                    <input type="date" id="Fulfill_till" name="Fulfill_till" required>

                    <br>
                    <br>
                    <button type="submit">Request</button>
                    <button type="reset">Clear Form</button>
                    <br>
                    <br>

                </form>
            </div>
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


<?php
include('include/footer.php');
?>