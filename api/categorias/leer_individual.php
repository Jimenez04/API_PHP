<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/basemysql.php';
    include_once '../../models/categoria.php';
    $database = new basemysql();
    $conexdb = $database->conexion();

    $categoria = new categoria($conexdb);
    //obtenerid
    $categoria->id = isset($_GET['id']) ? $_GET['id'] : die();
    //
    $categoria->leerindividual();
        $categoria_item = array(
            'id' => $categoria->id,
            'nombre' => $categoria->nombre
        );
    print_r(json_encode($categoria_item))
               
?>