<?php
include 'conexion.php';

$producto = null;
$error = null;
$eliminado = false;

// Verificar si se ha enviado el formulario para buscar el producto
if (isset($_POST['buscar'])) {
    $id = $_POST['id'];

    // Consulta para obtener los datos del producto
    $sql = "SELECT * FROM inventario WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se encontró el producto
    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
    } else {
        $error = "Producto no encontrado";
    }
}

// Verificar si se ha enviado el formulario para eliminar el producto
if (isset($_POST['eliminar'])) {
    $id = $_POST['id'];

    // Consulta para eliminar el producto
    $sql = "DELETE FROM inventario WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>alert('Producto eliminado con éxito');</script>";
        $producto = null; // Limpiar el formulario
        $eliminado = true;
    } else {
        echo "Error al eliminar el producto: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/eliminar.css">
    <title>Buscar y Eliminar Producto</title>
</head>
<body>
<header>
        <div class="titulo">
            <h1>Eliminar Artículo</h1>
            <a href="bienvenida.php"><img src="img/LOGO_SHOP.avif" alt=""></a>
        </div>
        <div class="botones">
            <div>
                <a href="registros.php">
                <p>Inventario</p>
                <img src="img/inventory.png" alt=""></a> 
            </div>
            <div>
                <a href="modulo_inventario.html">
                <p>Añadir artículo</p>
                <img src="img/add.png" alt=""></a>
            </div>
            <div>
                <a href="editar.php">
                <p>Editar artículo</p>
                <img src="img/edit.png" alt=""></a>
            </div>
            <div>
                <a href="eliminar.php">
                <p>Remover artículo</p>
                <img src="img/remove.png" alt=""></a>
            </div>
            <div>
                <a href="añadir_usuario.php">
                    <p>Añadir usuario</p>
                    <img src="img/person.png" alt="">
                </a>
            </div>
            <div>
                <a href="reporte.php">
                <p>Reporte</p>
                <img src="img/article.png" alt=""></a>
            </div>
        </div>
        <div class="contenido">
    <div class="form-container">
        <h2>Buscar Producto</h2>

        <form method="POST">
            <label for="id">ID del Producto:</label>
            <input type="number" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>" required>
            <button type="submit" name="buscar">Buscar Producto</button>
        </form>

        <?php if ($error): ?>
            <script>alert('<?php echo $error; ?>');</script>
        <?php endif; ?>
            <div class="info">
        <?php if ($producto): ?>
            <h3>Información del Producto</h3>
            <p><strong>ID:</strong> <?php echo $producto['id']; ?></p>
            <p><strong>Clave:</strong> <?php echo $producto['clave']; ?></p>
            <p><strong>Descripción:</strong> <?php echo $producto['descripcion']; ?></p>
            <p><strong>Precio Público:</strong> <?php echo $producto['precio_publico']; ?></p>
            <p><strong>Existencias:</strong> <?php echo $producto['existencias']; ?></p>
            </div>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                <button type="submit" name="eliminar">Eliminar Producto</button>
            </form>
        <?php endif; ?>
    </div>
    </div>
</body>
</html>
