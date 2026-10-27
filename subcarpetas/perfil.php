<?php
session_start();
include("connect.php");

if (!isset($_SESSION["usuario_id"])) {
    header("Location: registro.php");
    exit;
}

$id = $_SESSION["usuario_id"];
$sql = "SELECT nombre, apellido, email, personaje_favorito, puntos_quiz FROM usuarios WHERE id=?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$usuario = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$usuario) {
    session_destroy();
    header("Location: registro.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil | Gossip Girl</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="account-page">
<header class="account-header">
    <a href="../index.html">GOSSIP GIRL</a>
    <p>YOUR PERSONAL PAGE</p>
</header>
<main class="profile-main">
    <p class="profile-kicker">XOXO, GOSSIP GIRL</p>
    <h1>Hola, <?php echo htmlspecialchars($usuario["nombre"]); ?>.</h1>
    <section class="profile-card">
        <h2>Tu información personal</h2>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario["nombre"] . " " . $usuario["apellido"]); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario["email"]); ?></p>
    </section>

       <section class="profile-card">
    <h2>Tu personaje favorito</h2>
    <p><?php echo htmlspecialchars($usuario["personaje_favorito"]); ?></p>
    <?php
    $fotos = [
        "Blair Waldorf" => "blair.jpg",
        "Serena van der Woodsen" => "serena.jpg",
        "Chuck Bass" => "chuck.jpg",
        "Nate Archibald" => "nate.jpg",
        "Dan Humphrey" => "dan.jpg",
        "Jenny Humphrey" => "jenny.jpg"
    ];
    $personaje = $usuario["personaje_favorito"];
    if (isset($fotos[$personaje])) {
    ?>
        <img class="favorite-character"
             src="../img/<?php echo htmlspecialchars($fotos[$personaje]); ?>"
             alt="<?php echo htmlspecialchars($personaje); ?>">
    <?php } ?>
  </section>

    <div class="profile-links">
        <a href="../index.html">Volver al inicio</a>
        <a href="logout.php">Cerrar sesión</a>
    </div>

    <section class="profile-card">
    <h2>Tu recorrido en Gossip Girl</h2>
    <p class="profile-score">
        <?php echo (int)$usuario["puntos_quiz"]; ?> / 10 puntos
    </p>
    <p>Tu lugar en el Upper East Side te espera.</p>
</section>

</main>
</body>
</html>