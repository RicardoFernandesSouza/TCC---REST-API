<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['username']) && isset($_POST['password'])) {
 
    // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // get the user by email and password
    $cliente = $db->getUserByEmailAndPassword($username, $password);
 
    if ($cliente != false) {
        // use is found
        $response["error"] = FALSE;
        $response["cliente"]["id"] = $cliente["id"];
        $response["cliente"]["name"] = $cliente["name"];
        $response["cliente"]["username"] = $cliente["username"];
        $response["cliente"]["password"] = $cliente["password"];
        $response["cliente"]["email"] = $cliente["email"];
       // $response["password"] = $cliente["password"];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Informações de Login inválidas. Tente novamente!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters username or password is missing!";
     echo json_encode($response);
}
?>