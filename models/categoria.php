<?php 
    class categoria
    {
        //variables
        private $conex;
        private $tabla = 'categorias';
        public $id;
        public $nombre;
        public $fecha_creacion;
        //metodos
        public function __construct($db)
        {
            $this->conex = $db;
        }
        public function leertodo()
        {
            $consulta = "SELECT id, nombre, fecha_creacion from $this->tabla ORDER BY fecha_creacion DESC";
            $stmt = $this->conex->prepare($consulta);
            $resultado = $stmt->execute();
            return $stmt;
        }
        public function leerindividual()
        {
            $consulta = "SELECT id, nombre, fecha_creacion from $this->tabla where id = :id LIMIT 0,1";
            $stmt = $this->conex->prepare($consulta);
            $this->limpiardatos("id");
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->fecha_creacion = $row['fecha_creacion'];
        }
        public function crear()
        {
            $consulta = "INSERT INTO $this->tabla (nombre)values(:nombre)";
            $stmt = $this->conex->prepare($consulta);
            //Limpiar los datos
            $this->limpiardatos("nombre");
            $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
                if($stmt->execute())
                {
                    return true;
                }
                printf("Error $s.\n, $stmt->error");
                return false;
        }
        public function actualizar()
        {
            $consulta = "UPDATE $this->tabla SET nombre = :nombre WHERE id = :id";
            $stmt = $this->conex->prepare($consulta);
            //Limpiar los datos
            $this->limpiardatos("nombre");
            $this->limpiardatos("id");
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
                if($stmt->execute())
                {
                    return true;
                }
                printf("Error $s.\n, $stmt->error");
                return false;
        }
        public function borrar()
        {
            $consulta = "DELETE FROM $this->tabla WHERE id = :id";
            $stmt = $this->conex->prepare($consulta);
            //Limpiar los datos
            $this->limpiardatos("id");
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
                if($stmt->execute())
                {
                    return true;
                }
                printf("Error $s.\n, $stmt->error");
                return false;
        }
        public function limpiardatos($propiedad)
        {
            if (property_exists($this, $propiedad)) {
                $this->$propiedad = htmlspecialchars(strip_tags($this->$propiedad));
            }
            return $this;
        }

    }
?>