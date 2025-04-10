<?php
// Include database connection
include ('database/connection.php'); // Make sure to include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $H_id = $_POST['H_id'];

    // SQL query to delete the hospital
    $sql = "DELETE FROM tb_Hospital WHERE H_id = ?";
    $params = array($H_id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    // Check if the delete was successful
    if ($stmt === false) {
        die("Delete failed: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Hospital deleted successfully.";
        // Redirect back to the dashboard or display a success message
        header("Location:Show_Hospital.php"); // Change to your dashboard page
        exit();
    }

    // Free statement and connection resources
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>