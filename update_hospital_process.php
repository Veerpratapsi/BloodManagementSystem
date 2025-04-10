<?php
// Include database connection
include ('database/connection.php'); // Make sure to include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $H_id = $_POST['H_id'];
    $H_name = $_POST['H_name'];
    $H_contact = $_POST['H_contact'];
    $H_email = $_POST['H_email'];
    $H_address = $_POST['H_address'];
    $H_con_person = $_POST['H_con_person'];

    // SQL query to update the hospital data
    $sql = "UPDATE tb_Hospital SET H_name = ?, H_contact = ?, H_email = ?, H_address = ?, H_con_person = ? WHERE H_id = ?";
    $params = array($H_name, $H_contact, $H_email, $H_address, $H_con_person, $H_id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    // Check if the update was successful
    if ($stmt === false) {
        die("Update failed: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Hospital updated successfully.";
        // Redirect back to the dashboard or display a success message
        header("Location:Show_Hospital.php"); // Change to your dashboard page
        exit();
    }

    // Free statement and connection resources
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>