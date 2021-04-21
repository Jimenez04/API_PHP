<?php 
    class producto
    {
        //variables
        private $conex;
        private $tabla = 'productos';
        public $id;
        public $titulo;
        public $categoria_nombre;
        public $categoria_id;
        public $texto;
        public $fecha_creacion;
        //metodos
        public function __construct($db)
        {
            $this->conex = $db;
        }
        public function leertodo()
        {
            $consulta = "SELECT c.nombre as nombre, p.id, p.categoria_id, p.titulo, p.titulo, p.texto, p.fecha_creacion
                         from $this->tabla p LEFT JOIN categorias c on p.categoria_id = c.id ORDER BY p.fecha_creacion DESC";
            $stmt = $this->conex->prepare($consulta);
            $resultado = $stmt->execute();
            return $stmt;
        }
        public function leerindividual()
        {
            $consulta = "SELECT c.nombre as categoria_nombre, p.id, p.categoria_id, p.titulo, p.titulo, p.texto, p.fecha_creacion
                        from $this->tabla p LEFT JOIN categorias c on p.categoria_id = c.id where p.id = :id LIMIT 0,1";
            $stmt = $this->conex->prepare($consulta);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $this->limpiardatos("id");
            $resultado = $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->titulo = $row['titulo'];
            $this->texto = $row['texto'];
            $this->categoria_id = $row['categoria_id'];
            $this->categoria_nombre = $row['categoria_nombre'];
            $this->fecha_creacion = $row['fecha_creacion'];
        }
        public function crear()
        {
            $consulta = "INSERT INTO $this->tabla (titulo, texto, categoria_id) values(:titulo, :texto, :categoria_id)";
            $stmt = $this->conex->prepare($consulta);
            //Limpiar los datos
            $this->limpiardatos("titulo");
            $this->limpiardatos("texto");
            $this->limpiardatos("categoria_id");
            $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
            $stmt->bindParam(':texto', $this->texto, PDO::PARAM_STR);
            $stmt->bindParam(':categoria_id', $this->categoria_id, PDO::PARAM_INT);
                if($stmt->execute())
                {
                    return true;
                }
                printf("Error $s.\n, $stmt->error");
                return false;
        }
        public function actualizar()
        {
            $consulta = "UPDATE $this->tabla set titulo = :titulo, texto=:texto, categoria_id=:categoria_id 
                         where id = :id";
            $stmt = $this->conex->prepare($consulta);
            //Limpiar los datos
            $this->limpiardatos("titulo");
            $this->limpiardatos("texto");
            $this->limpiardatos("categoria_id");
            $this->limpiardatos("id");
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
            $stmt->bindParam(':texto', $this->texto, PDO::PARAM_STR);
            $stmt->bindParam(':categoria_id', $this->categoria_id, PDO::PARAM_INT);
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
        private function limpiardatos($propiedad)
        {
            if (property_exists($this, $propiedad)) {
                return $this->$propiedad = htmlspecialchars(strip_tags($this->$propiedad));
            }
            return $this;
        }
    }
?>