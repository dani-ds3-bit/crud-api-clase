<?php
    header('Content-Type: application/json');
    include("controllers.php");

    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? '';

    switch($method){
        case 'GET':
            if($action === 'users' || $action === '' || $action === 'register'){
                echo json_encode(getUsers());
            }
            break;

        case 'POST':
            if ($action === 'register' || $action === ''){
                echo json_encode(registerUsers());
            }
            elseif ($action == 'login'){
                echo json_encode(login());
            }
            break;
    }
?>
