<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    include_once '../../config/basemysql.php';
    include_once '../../models/categoria.php';

    $database = new basemysql();
    $conexdb = $database->conexion();
    $categoria = new categoria($conexdb);

    $data = json_decode(file_get_contents("php://input"));
    $categoria->nombre = $data->nombre;
    
    //crear
        if ($categoria->crear()) 
        {
            echo json_encode   
            (
                array('Message' => "categoria creada")
            );
        }else 
        {
            echo json_encode   
            (
                array('Message' => "categoria no creada")
            );
        }

    ?>