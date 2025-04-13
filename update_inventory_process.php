<?php
// update_process.php

// Include database connection
include ('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $BloodId = $_POST['bloodId'];
    $BloodType = $_POST['bloodType'];
    $Quantity = $_POST['quantity'];
    $EntryDate = $_POST['entryDate'];

    // Update donor data
    $sql = "UPDATE BloodInventory SET BloodType=?,Quantity=?,EntryDate=? WHERE BloodID=?";
    $params=array($BloodType,$Quantity,$EntryDate,$BloodId);
    $stmt = sqlsrv_query($conn, $sql, $params);
    

    if ($stmt === false) {
        die("Update failed: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Inventory updated successfully.";
        // Redirect back to the dashboard or display a success message
        header("Location:show_inventory.php"); // Change to your dashboard page
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>