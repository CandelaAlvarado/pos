<?php
include 'conexion.php';
$producto = null;
$error = null;
$actualizado = false;

// Verificar si se ha enviado el formulario para buscar el producto
if (isset($_POST['buscar'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM inventario WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
    } else {
        $error = "Producto no encontrado";
    }
}

// Verificar si se ha enviado el formulario para actualizar el producto
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $clave = $_POST['clave'];
    $descripcion = $_POST['descripcion'];
    $precio_publico = $_POST['precio_publico'];
    $existencias = $_POST['existencias'];

    
    $sql = "UPDATE inventario SET clave = ?, descripcion = ?, precio_publico = ?, existencias = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdii", $clave, $descripcion, $precio_publico, $existencias, $id);

    
    if ($stmt->execute()) {
        echo "<script>alert('Producto actualizado con éxito');</script>";
        $producto = null; 
        $actualizado = true; 
    } else {
        echo "Error al actualizar el producto: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/editar.css">
    <title>Editar Producto</title>
</head>
<body>
<header>
        <div class="titulo">
            <h1>Buscar y Editar Artículo</h1>
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
    <form method="POST">
        <label for="id">ID del Producto:</label>
        <input type="number" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>" required>
        <button type="submit" name="buscar">Buscar Producto</button>
    </form>

    <?php if ($error): ?>
        <script>alert('<?php echo $error; ?>');</script>
    <?php endif; ?>
    <?php if ($producto && !$actualizado): ?>
        <h3>Editar Producto</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            
            <label for="clave">Clave:</label><br>
            <input type="text" name="clave" value="<?php echo $producto['clave']; ?>" required><br><br>

            <label for="descripcion">Descripción:</label><br>
            <input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>" required><br><br>

            <label for="precio_publico">Precio Público:</label><br>
            <input type="number" step="0.01" name="precio_publico" value="<?php echo $producto['precio_publico']; ?>" required><br><br>

            <label for="existencias">Existencias:</label><br>
            <input type="number" name="existencias" value="<?php echo $producto['existencias']; ?>" required><br><br>

            <button type="submit" name="actualizar">Actualizar Producto</button>
        </form>
    </div>
    <?php elseif ($actualizado): ?>
        <p>El producto ha sido actualizado. Puedes buscar otro producto si lo deseas.</p>
    <?php endif; ?>
    </div>
</body>
</html>
