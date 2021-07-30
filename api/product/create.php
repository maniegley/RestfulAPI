<?php
// required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
    // get database connection
    include_once '../config/database.php';
  
    // instantiate product object
    include_once '../objects/product.php';
  
    $database = new Database();
    $db = $database->getConnection();
  
    $product = new Product($db);
  
    //echo "USer data";
    // get posted data
    //$j = $_POST['user'];
    //echo $j;
    //$ip = $j['ipaddr'];
    //$pwd = $j['pwd'];
    echo $ip;
    $ip = $_GET['ipaddr'];
    $pwd = $_GET['pwd'];
    //echo $ip;
    //echo $pwd;
    
    $jsonobj = '{"ipaddr":'.$ip.',"pwd":' . $pwd. '}';
    echo $jsonobj;
    //Create Json object from string
    $data = json_decode($jsonobj);
    echo $data->ipaddr;
  
// make sure data is not empty
    if(
        !empty($data->ipaddr) &&
        !empty($data->pwd)
    ){
  
        // set product property values
        $product->ipaddr = $data->ipaddr;
        $product->pwd = $data->pwd;
  
        // create the product
        if($product->create()){
  
            // set response code - 201 created
            http_response_code(201);
  
            // tell the user
            echo json_encode(array("message" => "User was created successfully."));
        }
  
        // if unable to create the product, tell the user
        else{
  
            // set response code - 503 service unavailable
            http_response_code(503);
  
            // tell the user
            echo json_encode(array("message" => "Unable to create user. Please try again!!!"));
        }
    }
  
    // tell the user data is incomplete
    else{
  
        // set response code - 400 bad request
        http_response_code(400);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
    }
?>