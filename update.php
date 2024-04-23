<?php 

include_once "connections.php";
include_once "colores.php";

echo $_GET['id']."<br />";
echo $_GET['usuario']."<br />";

echo $_GET['color'];


$insert = "UPDATE info_colores SET color = ?, usuario = ?, color_user = ?  WHERE id = ?";


$insert_prepare = $conn->prepare($insert);
$insert_prepare->execute([$_GET['color'], $_GET['usuario'], $colores[$_GET['colores']],$_GET['id']]);


$insert_prepare = null;
$conn = null;

header('location:index.php');