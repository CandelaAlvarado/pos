<?php
require('fpdf/fpdf.php'); 

include 'conexion.php';

function generarPDFInventario($conexion) {
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->Image('img/LOGO_SHOP1.png', 150, 10, 40); 

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Reporte de Inventario', 0, 1, 'L');

    $pdf->Ln(20);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(15, 10, 'Clave', 1);
    $pdf->Cell(90, 10, 'Descripcion', 1);
    $pdf->Cell(40, 10, 'Precio', 1);
    $pdf->Cell(40, 10, 'Existencias', 1);
    $pdf->Ln();

    $sql = "SELECT  clave, descripcion, precio_publico, existencias FROM inventario";
    $resultado = $conexion->query($sql);

    $pdf->SetFont('Arial', '', 12);
    while ($row = $resultado->fetch_assoc()) {
        $pdf->Cell(15, 10, $row['clave'], 1);
        $pdf->Cell(90, 10, $row['descripcion'], 1);
        $pdf->Cell(40, 10, $row['precio_publico'], 1);
        $pdf->Cell(40, 10, $row['existencias'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'reporte_inventario.pdf');
}

function generarPDFUsuarios($conexion) {
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->Image('img/LOGO_SHOP1.png', 150, 10, 40);

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Reporte de Usuarios', 0, 1, 'L');

    $pdf->Ln(20); 

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Nickname', 1);
    $pdf->Cell(40, 10, 'Clave', 1);
    $pdf->Cell(40, 10, 'Perfil', 1);
    $pdf->Ln();

    $sql = "SELECT nickname, clave, perfil FROM usuarios";
    $resultado = $conexion->query($sql);

    $pdf->SetFont('Arial', '', 12);
    while ($row = $resultado->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['nickname'], 1);
        $pdf->Cell(40, 10, $row['clave'], 1);
        $pdf->Cell(40, 10, $row['perfil'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'reporte_usuarios.pdf');
}

if (isset($_POST['generar'])) {
    $opcion = $_POST['opcion'];

    if ($opcion == 'inventario') {
        generarPDFInventario($conexion);
    } elseif ($opcion == 'usuarios') {
        generarPDFUsuarios($conexion);
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/reporte.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Generar PDF</title>
</head>
<body>
<header>
        <div class="titulo">
            <h1>Generar Reporte</h1>
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
        <h2>Generar Reporte en PDF</h2>
        <form method="POST">
            <label for="opcion">Selecciona el tipo de reporte:</label>
            <select name="opcion" required>
                <option value="inventario">Reporte de Inventario</option>
                <option value="usuarios">Reporte de Usuarios</option>
            </select>
            <button type="submit" name="generar">Generar</button>
        </form>
    </div>
    </div>
</body>
</html>