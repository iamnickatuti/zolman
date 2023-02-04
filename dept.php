<?php

$config = parse_ini_file('./credentials.ini');
$conn = mysqli_connect($config['dbhost'], $config['username'], $config['password']);
mysqli_select_db($conn, $config['db']);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Get data from the REST client
    $dept_no = isset($_POST['dept_no']) ? mysqli_real_escape_string($conn, $_POST['dept_no']) : "";
    $dept_name= isset($_POST['dept_name']) ? mysqli_real_escape_string($conn, $_POST['dept_no']) : "";

    // Insert data into database
    $sql = "INSERT INTO `employees`.`departments` (`dept_no`, `dept_name`) VALUES (`$dept_no`,`$dept_name`);";
    $post_data_query = mysqli_query($conn, $sql);
    if($post_data_query){
        $json = array("status" => 1, "Success" => "Department has been added successfully!");
    }
    else{
        $json = array("status" => 0, "Error" => "Error adding Department! Please try again!");
    }
}
else{
    $json = array("status" => 0, "Info" => "Request method not accepted!!");
}
mysqli_close($conn);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);