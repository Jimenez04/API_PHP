<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/basemysql.php';
    include_once '../../models/producto.php';
    $database = new basemysql();
    $conexdb = $database->conexion();

    $productos = new producto($conexdb);
    $resultado = $productos->leertodo();
    $num = $resultado->rowCount();
        if ($num!=0) {
            $lista_producto = array();
            $lista_producto['data'] = array();
            while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                    $producto_item = array(
                        'id' => $id,
                        'titulo' => $titulo,
                        'texto' => $texto,
                        'categoria' => $nombre,
                        'categoria_id' => $categoria_id,
                        'fecha_creacion' => $fecha_creacion
                    );
                array_push($lista_producto['data'], $producto_item);
            }
               echo json_encode($lista_producto);
        }else {
            echo json_encode(array('message' => 'No hay categorias'));
        }
?>