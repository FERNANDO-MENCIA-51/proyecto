<?php
require_once '/module/php/conexion.php';

// Manejar la inserción de nuevos eventos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];
        
        // Procesar la imagen
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        
        $sql = "INSERT INTO eventos (titulo, descripcion, fecha, imagen) 
                VALUES (:titulo, :descripcion, :fecha, :imagen)";

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);

        $stmt->execute();

        echo json_encode(["success" => true, "message" => "Evento guardado exitosamente"]);

    } catch(PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error al guardar el evento: " . $e->getMessage()]);
    }
}

// Obtener todos los eventos
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $sql = "SELECT id, titulo, descripcion, fecha, imagen FROM eventos ORDER BY fecha";
        $stmt = $conn->query($sql);
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Convertir las imágenes BLOB a base64
        foreach ($eventos as &$evento) {
            $evento['imagen'] = base64_encode($evento['imagen']);
        }

        echo json_encode(["success" => true, "eventos" => $eventos]);

    } catch(PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error al obtener eventos: " . $e->getMessage()]);
    }
}

cerrarConexion();
?>
