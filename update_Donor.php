<?php
// update_Donor.php

// Include database connection
include ('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $D_id = $_POST['D_id'];

    // Fetch current donor data
    $sql = "SELECT D_id,D_name, D_bloodtype,D_age,D_gender,D_identification,D_medical,D_contact,D_email,D_address,D_Last_Donation FROM tb_Donor WHERE D_id = ?";
    $params = array($D_id);
    $stmt = sqlsrv_query($conn, $sql, $params);
    $donor = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    

    // Check if donor exists
    if (!$donor) {
        echo "Donor not found.";
        exit;
    }

    // Display form for updating donor details
    ?>
    <form action="update_donor_process.php" method="post">
        <input type="hidden" name="D_id" value="<?= htmlspecialchars($donor['D_id']); ?>">
        Name: <input type="text" name="D_name" value="<?= htmlspecialchars($donor['D_name']); ?>"><br>
        Blood Type: <input type="text" name="D_bloodtype" value="<?= htmlspecialchars($donor['D_bloodtype']); ?>"><br>
        Age: <input type="number" name="D_age" value="<?= htmlspecialchars($donor['D_age']); ?>"><br>
        Gender: <input type="text" name="D_gender" value="<?= htmlspecialchars($donor['D_gender']); ?>"><br>
        Identification: <input type="text" name="D_identification" value="<?= htmlspecialchars($donor['D_identification']); ?>"><br>
        Medical History: <input type="text" name="D_medical" value="<?= htmlspecialchars($donor['D_medical']); ?>"><br>
        Contact: <input type="text" name="D_contact" value="<?= htmlspecialchars($donor['D_contact']); ?>"><br>
        Email: <input type="email" name="D_email" value="<?= htmlspecialchars($donor['D_email']); ?>"><br>
        Address: <input type="text" name="D_address" value="<?= htmlspecialchars($donor['D_address']); ?>"><br>
        Last Donation: <input type="text" name="D_Last_Donation" value="<?= htmlspecialchars($donor['D_Last_Donation']); ?>"><br>
        <input type="submit" value="Update Donor">
    </form>
    <?php
}
?>