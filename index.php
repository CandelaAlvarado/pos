<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/index.css">
    <title>Login</title>
</head>
<body>
    <div>
        <img src="img/LOGO_SHOP.avif" alt="">
    </div>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="clave">Clave:</label>
            <input type="text" id="clave" name="clave" required>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
    <?php
        include 'conexion.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre']);
            $clave = trim($_POST['clave']); 
        
            $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nickname = ? AND clave = ?");
            $stmt->bind_param("ss", $nombre, $clave);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                header("Location: bienvenida.php"); 
                exit();
            } else {
                echo "<div class='mensaje'>Usuario o clave incorrectos</div>";
            }
        
            $stmt->close();
            $conexion->close();
        }
    ?>

</body>
</html>