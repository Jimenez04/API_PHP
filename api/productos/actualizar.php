<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    include_once '../../config/basemysql.php';
    include_once '../../models/producto.php';

    $database = new basemysql();
    $conexdb = $database->conexion();
    $producto = new producto($conexdb);

    $data = json_decode(file_get_contents("php://input"));
    $producto->id = $data->id;
    $producto->titulo = $data->titulo;
    $producto->texto = $data->texto;
    $producto->categoria_id = $data->categoria_id;
    
    //crear
        if ($producto->actualizar()) 
        {
            echo json_encode   
            (
                array('Message' => "producto actualizado")
            );
        }else 
        {
            echo json_encode   
            (
                array('Message' => "producto no actualizado")
            );
        }

    ?>