<?php
session_start();
include("connect.php");
mysqli_report(MYSQLI_REPORT_OFF);
$mensaje = isset($_GET["cerrada"]) ? "Cerraste sesión correctamente." : "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"] ?? "";
    $email = trim($_POST["email"] ?? "");
    if ($accion == "registro") {
        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $personaje = $_POST["personaje_favorito"];
        $clave = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, apellido, email, personaje_favorito, `contraseña`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $email, $personaje, $clave);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION["usuario_id"] = mysqli_insert_id($conexion);
                header("Location: perfil.php"); exit;
            } else $mensaje = "No se pudo registrar. Revisá si el email ya existe.";
        } else $mensaje = "Error al preparar el registro.";
    } elseif ($accion == "login") {
        $stmt = mysqli_prepare($conexion, "SELECT id, `contraseña` FROM usuarios WHERE email = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $u = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            if ($u && password_verify($_POST["contraseña"], $u["contraseña"])) {
                $_SESSION["usuario_id"] = $u["id"];
                header("Location: perfil.php"); exit;
            } else $mensaje = "Email o contraseña incorrectos.";
        } else $mensaje = "Error al iniciar sesión.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gossip Girl | Registro</title>
<link rel="stylesheet" href="../css/estilos.css">
</head>

<body>

<header>

<nav>

<div class="logo">GOSSIP GIRL</div>

<ul class="menu">
    <li><a href="../index.html">Home</a></li>
    <li><a href="personajes.html">Personajes</a></li>
    <li><a href="temporadas.html">Temporadas</a></li>
    <li><a href="upper-east-side.html">Upper East Side</a></li>
    <li><a href="relaciones.php">Relaciones</a></li>
    <li><a href="registro.php">Registro</a></li>
</ul>

</nav>

</header>

<div class="background-hero"></div>

<main>

<section class="register">

<p class="section-title">JOIN THE UPPER EAST SIDE</p>

<h1>Crear cuenta</h1>

<p class="register-intro">
Registrate para recibir los últimos rumores de Gossip Girl.
</p>

<?php if ($mensaje != "") { ?>
    <p><?php echo htmlspecialchars($mensaje); ?></p>
<?php } ?>

<div class="account-options">
    <button type="button" onclick="mostrarFormulario('registro')">Registrarme</button>
    <button type="button" onclick="mostrarFormulario('login')">Iniciar sesión</button>
</div>

<p class="account-message"><?php echo htmlspecialchars($mensaje); ?></p>

<form id="form-registro" action="registro.php" method="POST">
    <input type="hidden" name="accion" value="registro">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellido" placeholder="Apellido" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="contraseña" placeholder="Contraseña" required>
    <select name="personaje_favorito" required>
        <option value="">Personaje favorito</option>
        <option value="Blair Waldorf">Blair Waldorf</option>
        <option value="Serena van der Woodsen">Serena van der Woodsen</option>
        <option value="Chuck Bass">Chuck Bass</option>
        <option value="Nate Archibald">Nate Archibald</option>
        <option value="Dan Humphrey">Dan Humphrey</option>
        <option value="Jenny Humphrey">Jenny Humphrey</option>
    </select>
    <button type="submit">Crear cuenta</button>
</form>

<form id="form-login" action="registro.php" method="POST" style="display:none;">
    <input type="hidden" name="accion" value="login">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="contraseña" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
</form>

<script>
function mostrarFormulario(tipo) {
    document.getElementById("form-registro").style.display =
        tipo === "registro" ? "flex" : "none";
    document.getElementById("form-login").style.display =
        tipo === "login" ? "flex" : "none";

    document.querySelectorAll(".account-options button").forEach(b => {
        b.classList.remove("active");
    });

    document.querySelector(
        tipo === "registro"
            ? '.account-options button[onclick*="registro"]'
            : '.account-options button[onclick*="login"]'
    ).classList.add("active");
}
mostrarFormulario("registro");
</script>


</section>

</main>

 <footer>

   <div class="footer-grid">

   <div>

 <h3>GOSSIP GIRL</h3>

 <p>Fan website desarrollado para Producción Digital II.</p>

 </div>

 <div>

 <p>Home</p>

 <p>Personajes</p>

 <p>Temporadas</p>

 </div>

 <div>

 <p>Upper East Side</p>

 <p>Relaciones</p>

 <p>Registro</p>

 </div>

 </div>
 
 <p class="copyright">

 © 2026 · XOXO, Gossip Girl

 </p>

</footer>

</body>
</html>