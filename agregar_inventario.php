
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
    include 'conexion.php';

    $consulta = $conexion->prepare("INSERT INTO inventario (clave, descripcion, precio_publico, existencias) VALUES(?,?,?,?)");

    $consulta->bind_param("ssdi", $clave, $descripcion, $precio_publico, $existencias);

    $clave = $_POST["clave"];
    $descripcion = $_POST["descipcion"];
    $precio_publico = $_POST["precio_publico"];
    $existencias = $_POST["existencias"];

    
    if ($consulta->execute()){
        echo "<div class='mensaje'>Registro agregado al inventario correctamente.</div>";
    } else {
        echo "<div class='mensaje'>Error al agregar el registro al inventario: </div>" . $consulta->error;
    }

    $conexion->close();
?>
<div class="contenedor">
<a href="modulo_inventario.html"><img src="img/back.png" alt=""></a>
</div>
</body>
<style>
    body{
        background-color: #151414;
        color:white;
    }
    .mensaje{
        margin-top:80px;
        text-align:center;
        font-size:25px;
    }

    .contenedor{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    }
</style>
</html>