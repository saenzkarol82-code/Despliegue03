<?php
#control de recepcion de datos
#var_dump($_POST);
$conexion = new PDO('pgsql:host=dpg-d8f3936rnols73aluuqg-a.oregon-postgres.render.com;dbname=sena_h0dw','sena_h0dw_user','2RN9lMdkwRVG6q8iX54je0ENCFQ7AWRe');
$registrar = $conexion->prepare("INSERT INTO aprendices (nombre,telefono,detalles) VALUES (?, ?, ?)");
$registrar->execute([$_POST["nom"], $_POST["tel"], $_POST["det"]]);

$consulta = $conexion->prepare("SELECT * FROM aprendices ORDER BY id");
$consulta->execute();
$tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro de Aprendices</title>
<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        padding: 20px;
    }
    .mensaje-exito {
        background-color: #28a745;
        color: white;
        text-align: center;
        padding: 15px;
        font-size: 22px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    table {
        width: 90%;
        margin: 0 auto;
        border-collapse: collapse;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        background-color: white;
        border-radius: 6px;
        overflow: hidden;
    }
    th {
        background-color: #007bff;
        color: white;
        padding: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #eef;
    }
</style>
</head>
<body>

<div class="mensaje-exito">Registro exitoso</div>

<table>
    <tr>
        <th>Código</th>
        <th>Nombre completo</th>
        <th>Contacto</th>
        <th>Detalles</th>
    </tr>
    <?php foreach($tabla as $fila): ?>
    <tr>
        <td><?= $fila['id'] ?></td>
        <td><?= htmlspecialchars($fila['nombre']) ?></td>
        <td><?= htmlspecialchars($fila['telefono']) ?></td>
        <td><?= htmlspecialchars($fila['detalles']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
