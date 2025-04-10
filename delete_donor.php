<?php
// delete_Donor.php

// Include database connection
include ('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $D_id = $_POST['D_id'];

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM tb_donor WHERE D_id = ?";
    $params = array($D_id);
    $stmt = sqlsrv_query($conn, $sql, $params);
    
   
    
    if ($stmt === false) {
        die("Delete failed: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Hospital deleted successfully.";
        // Redirect back to the dashboard or display a success message
        header("Location:donor.php"); // Change to your dashboard page
        exit();
    }
}
?>