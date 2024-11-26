<?php
include 'conexion.php';


if (isset($_POST['registrar'])) {
    $nikname = $_POST['nikname'];
    $password = $_POST['password'];
    $clave = $_POST['clave'];
    $perfil = $_POST['perfil'];

    $sql = "INSERT INTO usuarios (nickname, password, clave, perfil) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nikname, $password, $clave, $perfil);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario registrado con éxito');</script>";
    } else {
        echo "<script>alert('Error al registrar el usuario');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos/añadir_usuario.css"> 
</head>
<body>
<header>
        <div class="titulo">
            <h1>Añadir Usuario</h1>
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
        <h2>Registrar Usuario</h2>

        <form method="POST">
            <label for="nikname">Nikname:</label>
            <input type="text" name="nikname" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="clave">Clave:</label>
            <input type="text" name="clave" required>

            <label for="perfil">Perfil:</label>
            <input type="text" name="perfil" required>

            <button type="submit" name="registrar">Registrar</button>
        </form>
    </div>
    </div>
</body>
</html>
