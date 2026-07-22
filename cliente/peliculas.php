<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
    exit();
}

$resultado = $conexion->query("SELECT * FROM peliculas");

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Películas</title>
<link rel="stylesheet" href="../estilos.css">
</head>

<body>

<h1>🎬 Películas Disponibles</h1>

<h2>Bienvenido <?php echo $_SESSION['usuario']; ?></h2>

<a href="../dashboard.php">
<button>⬅ Volver</button>
</a>

<br><br>


<table>

<tr>
<th>Título</th>
<th>Género</th>
<th>Duración</th>
<th>Clasificación</th>
<th>Acción</th>
</tr>


<?php while($fila = $resultado->fetch_assoc()){ ?>

<tr>

<td><?php echo $fila['titulo']; ?></td>

<td><?php echo $fila['genero']; ?></td>

<td><?php echo $fila['duracion']; ?> min</td>

<td><?php echo $fila['clasificacion']; ?></td>

<td>
<a href="../boletos/index.php?id_pelicula=<?php echo $fila['id']; ?>">
<button>🎟️ Comprar</button>
</a>
</td>

</tr>

<?php } ?>


</table>


</body>
</html>