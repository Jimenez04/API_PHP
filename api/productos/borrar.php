<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: Delete');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    include_once '../../config/basemysql.php';
    include_once '../../models/producto.php';

    $database = new basemysql();
    $conexdb = $database->conexion();
    $producto = new producto($conexdb);

    $data = json_decode(file_get_contents("php://input"));
    $producto->id = $data->id;
    
    //borrar
        if ($producto->borrar()) 
        {
            echo json_encode   
            (
                array('Message' => "producto borrado")
            );
        }else 
        {
            echo json_encode   
            (
                array('Message' => "producto no borrado")
            );
        }

    ?>