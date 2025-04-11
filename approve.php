<?php
include('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the request ID from the form submission
    $request_id = $_POST['request_id'];

    // First, retrieve the request details from the current table
    $sqlSelect = "SELECT * FROM tb_H_request WHERE H_R_id = ?";
    $paramsSelect = array($request_id);
    $stmtSelect = sqlsrv_query($conn, $sqlSelect, $paramsSelect);

    if ($stmtSelect === false) {
        error_log(print_r(sqlsrv_errors(), true));
        echo "Error retrieving request details.";
        exit;
    }

    // Fetch the request data
    $requestData = sqlsrv_fetch_array($stmtSelect, SQLSRV_FETCH_ASSOC);
    
    // Check if requestData is not empty
    if ($requestData) {
        // Prepare the INSERT statement for the new table
        $sqlInsert = "INSERT INTO tb_approved_requests (H_R_id, h_id, Requested_qnt, H_R_BloodGrp, Fulfill_till) VALUES (?, ?, ?, ?, ?)";
        $paramsInsert = array(
            $requestData['h_r_id'],          // Ensure this key exists
            $requestData['H_id'],            // Ensure this key exists
            $requestData['Requested_qnt'],   // Ensure this key exists
            $requestData['H_R_BloodGrp'],    // Ensure this key exists
            $requestData['Fulfill_till']     // Ensure this key exists
        );

        // Execute the INSERT query
        $stmtInsert = sqlsrv_query($conn, $sqlInsert, $paramsInsert);

        if ($stmtInsert === false) {
            error_log(print_r(sqlsrv_errors(), true));
            echo "Error moving request to approved requests.";
            exit;
        }
    // Update the status of the request to 'approved'
    $sqlUpdate = "UPDATE tb_H_request SET status = 'approved' WHERE H_R_id = ?";
    $paramsUpdate = array($request_id);
    $stmtUpdate = sqlsrv_query($conn, $sqlUpdate, $paramsUpdate);

    if ($stmtUpdate === false) {
        error_log(print_r(sqlsrv_errors(), true));
        echo "Error updating request status to approved.";
        exit;
    }

    echo "Request approved successfully.";
    header("Location:show_requests.php"); 
    exit();
}
    // Free statements and close connection
    sqlsrv_free_stmt($stmtSelect);
    sqlsrv_free_stmt($stmtInsert);
    sqlsrv_free_stmt($stmtUpdate);
    sqlsrv_close($conn);
}
?>