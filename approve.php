<?php
include('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the request ID from the form submission
    $request_id = $_POST['request_id'];

    // Prepare the DELETE statement
    $sql = "DELETE FROM tb_H_request WHERE H_R_id = ?";
    $params = array($request_id);

    // Execute the query
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        // Handle error
        error_log(print_r(sqlsrv_errors(), true));
        echo "Error deleting request.";
    } else {
        echo "Request deleted successfully.";
        header("Location:Show_requests.php"); // Change to your dashboard page
        exit();
    }

    // Free statement and close connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>