<?php
session_start();
include("connect.php");
if (!isset($_SESSION["usuario_id"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(403);
    exit;
}
$puntos = (int)($_POST["puntos"] ?? 0);
$puntos = max(0, min(10, $puntos));
$stmt = mysqli_prepare($conexion, "UPDATE usuarios SET puntos_quiz = ? WHERE id = ?");
mysqli_stmt_bind_param($stmt, "ii", $puntos, $_SESSION["usuario_id"]);
echo mysqli_stmt_execute($stmt) ? "ok" : "error";
?>