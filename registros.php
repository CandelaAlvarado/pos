<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/registros.css">
    <title>Registros</title>
</head>
<body>
    <header>
        <div class="titulo">
            <h1>Consulta De Inventario</h1>
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
        <div class="tabla">
        <?php
            include 'conexion.php';

            $sql = "SELECT  id,clave, descripcion, precio_publico, existencias FROM inventario";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>ID</th>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Precio Público</th>
                            <th>Existencias</th>
                        </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["clave"] . "</td>
                            <td>" . $row["descripcion"] . "</td>
                            <td>" . $row["precio_publico"] . "</td>
                            <td>" . $row["existencias"] . "</td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "0 resultados";
            }

            $conexion->close();
            ?>
    </div>
    </div>
            
    </header>
    

</body>
</html>