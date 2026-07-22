<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
    exit();
}

$resultado = $conexion->query("
SELECT
    funciones.id,
    peliculas.titulo,
    salas.nombre AS sala,
    funciones.fecha,
    funciones.hora,
    funciones.precio

FROM funciones

INNER JOIN peliculas
ON funciones.pelicula_id = peliculas.id

INNER JOIN salas
ON funciones.sala_id = salas.id

ORDER BY funciones.fecha, funciones.hora
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Funciones Disponibles</title>
<link rel="stylesheet" href="../estilos.css">
</head>

<body>

<h1>📅 Funciones Disponibles</h1>

<h2>Bienvenido <?php echo $_SESSION['usuario']; ?></h2>

<a href="../dashboard.php">
<button>⬅ Volver</button>
</a>

<br><br>

<table>

<tr>
<th>Película</th>
<th>Sala</th>
<th>Fecha</th>
<th>Hora</th>
<th>Precio</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()){ ?>

<tr>

<td><?php echo $fila['titulo']; ?></td>

<td><?php echo $fila['sala']; ?></td>

<td><?php echo $fila['fecha']; ?></td>

<td><?php echo $fila['hora']; ?></td>

<td>$<?php echo number_format($fila['precio'],2); ?></td>

</tr>

<?php } ?>

</table>

</body>
</html>