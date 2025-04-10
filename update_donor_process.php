<?php
// update_process.php

// Include database connection
include ('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $D_id = $_POST['D_id'];
    $D_name = $_POST['D_name'];
    $D_bloodtype = $_POST['D_bloodtype'];
    $D_age = $_POST['D_age'];
    $D_gender = $_POST['D_gender'];
    $D_identification = $_POST['D_identification'];
    $D_medical = $_POST['D_medical'];
    $D_contact = $_POST['D_contact'];
    $D_email = $_POST['D_email'];
    $D_address = $_POST['D_address'];
    $D_Last_Donation = $_POST['D_Last_Donation'];

    // Update donor data
    $sql = "UPDATE tb_donor SET D_name=?, D_bloodtype=?, D_age=?, D_gender=?, D_identification=?, D_medical=?, D_contact=?, D_email=?, D_address=?, D_Last_Donation=? WHERE D_id=?";
    $params=array($D_name, $D_bloodtype, $D_age, $D_gender, $D_identification, $D_medical, $D_contact, $D_email, $D_address, $D_Last_Donation, $D_id);
    $stmt = sqlsrv_query($conn, $sql, $params);
    

    if ($stmt === false) {
        die("Update failed: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Donor updated successfully.";
        // Redirect back to the dashboard or display a success message
        header("Location:Donor.php"); // Change to your dashboard page
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>