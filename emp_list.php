<?php
include_once('./dbconn.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Get data from the REST client
    $birth_date = isset($_POST['birth_date']) ? mysqli_real_escape_string($conn, $_POST['birth_date']) : "";
    $first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($conn, $_POST['first_name']) : "";
    $last_name = isset($_POST['last_name']) ? mysqli_real_escape_string($conn, $_POST['last_name']) : "";
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : "";
    $hire_date = isset($_POST['hire_date']) ? mysqli_real_escape_string($conn, $_POST['hire_date']) : "";
    // Insert data into database
    $sql = "INSERT INTO `employees`.`employees` (`birth_date`, `first_name`, `last_name`, `gender`, `hire_date`) VALUES ('$birth_date', '$first_name', '$last_name',`$gender`,`$hire_date`);";
    $post_data_query = mysqli_query($conn, $sql);
    if($post_data_query){
        $json = array("status" => 1, "Success" => "Employee has been added successfully!");
    }
    else{
        $json = array("status" => 0, "Error" => "Error adding Employees! Please try again!");
    }
}
else{
    $json = array("status" => 0, "Info" => "Request method not accepted!!");
}
@mysqli_close($conn);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);