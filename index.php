<?php

include_once "connection.php";


$select = "SELECT * FROM info_colores";

$select_prepare = $conn->prepare($select);
$select_prepare->execute();

$resultado_select = $select_prepare->fetchAll();

// var_dump($resultado_select);
// print_r($resultado_select);


// foreach($resultado_select as $key => $value) {
//     echo $value["color"]. "<br>";
// }

if ($_POST) {
    var_dump($_POST);

    $color = $_POST["color"];
    $usuario = $_POST["usuario"];

    $insert = "INSERT INTO info_colores (color, usuario, color_user) VALUES (? , ? , ?)";
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$color, $usuario, $colores[$color]]);


    $insert_prepare = null;
    $conn = null;

    header('location:index.php');
}

if ($_GET) {
    echo $_GET["id"];
}

?>

<!-- ----------------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1 class="text-center">Nuestros colores favoritos</h1>
    </header>

    <main class="container my-5">
        <div class="row gx-5">
            <section class="col-sm-6 section1">
                <?php foreach ($resultado_select as $row) : ?>
                    <div class="row alert" style="color:white;background-color:<?= $row["color"] ?>" role="alert">
                        <!-- <?php echo $row["usuario"] . " : " . $row["color"] ?> -->
                        <div class="col-sm-9">
                            <?= $row["usuario"] . " : " . $row["color_user"] ?>
                        </div>
                        <div class="col-sm-3 text-end">
                            <a href="index.php?id=<?= $row["id"] ?>&usuario=<?= $row["usuario"] ?>&color=<?= $row["color"] ?>">✏</a>
                            <a href="delete.php?id=<?= $row["id"] ?>">🗑</a>
                        </div>

                    </div>
                <?php endforeach ?>

            </section>


            <section class="col-sm-6 section2">

                <?php if (!$_GET) : ?>
                    <form method="POST">
                        <fieldset>
                            <legend>Introduce los datos</legend>
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario :</label>
                                <input type="text" name="usuario" class="form-control" id="usuario" aria-describedby="usuario">
                            </div>
                            <div class="mb-3">
                                <label for="color" class="form-label">Color seleccionado</label>
                                <select name="color" id="color">
                                    <option value="darkblue" selected>Azul</option>
                                    <option value="darkred">Rojo</option>
                                    <option value="darkgreen">Verde</option>
                                    <option value="orange">Naranja</option>
                                </select>
                            </div>
                            <div class="row gap-2">
                                <button type="submit" class="col btn btn-primary">Submit</button>
                                <button type="reset" class="col btn btn-danger">Borrar</button>
                            </div>
                        </fieldset>
                    </form>

                <?php endif ?>


                <?php if ($_GET) : ?>
                    <form method="GET">
                        <fieldset>
                            <legend>Actualiza la información</legend>
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario :</label>
                                <input type="text" name="usuario" class="form-control" id="usuario" aria-describedby="usuario" value='<?= $_GET['usuario']?>'>
                            </div>
                            <div class="mb-3">
                                <label for="color" class="form-label">Color seleccionado</label>
                                <select name="color" id="color">
                                    <option value="blue" selected>Azul</option>
                                    <option value="yellow">Amarillo</option>
                                    <option value="red">Rojo</option>
                                    <option value="green">Verde</option>
                                </select>
                            </div>
                            <div class="row gap-2">
                                <button type="submit" class="col btn btn-primary">Submit</button>
                                <button type="reset" class="col btn btn-danger">Borrar</button>
                            </div>
                            <div class="my-3 ">
                                <p class="text-center">
                                    <a href="index.php">Cancelar</a>
                                </p>
                            </div>
                        </fieldset>

                    </form>
                <?php endif ?>

            </section>
        </div>

    </main>

</body>

</html>