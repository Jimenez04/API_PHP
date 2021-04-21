<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/basemysql.php';
    include_once '../../models/producto.php';
    $database = new basemysql();
    $conexdb = $database->conexion();

    $producto = new producto($conexdb);
    //obtenerid
    $producto->id = isset($_GET['id']) ? $_GET['id'] : die();
    //
    $producto->leerindividual();
        $producto_item = array(
                        'id' => $producto->id,
                        'titulo' => $producto->titulo,
                        'texto' => $producto->texto,
                        'categoria' => $producto->categoria_nombre,
                        'categoria_id' => $producto->categoria_id,
                        'fecha_creacion' => $producto->fecha_creacion
        );
    print_r(json_encode($producto_item))
               
?>