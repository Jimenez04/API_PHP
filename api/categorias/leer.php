<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/basemysql.php';
    include_once '../../models/categoria.php';
    $database = new basemysql();
    $conexdb = $database->conexion();

    $categoria = new categoria($conexdb);
    $resultado = $categoria->leertodo();
    $num = $resultado->rowCount();
        if ($num!=0) {
            $lista_categoria = array();
            $lista_categoria['data'] = array();
            while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                    $categoria_item = array(
                        'id' => $id,
                        'nombre' => $nombre
                    );
                array_push($lista_categoria['data'], $categoria_item);
            }
               // Se configura el json
               echo json_encode($lista_categoria);
        }else {
            echo json_encode(array('message' => 'No hay categorias'));
        }
?>