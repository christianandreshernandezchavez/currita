<?php
include 'conexion.php';

// Validar que se hayan enviado los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $edad = $_POST['edad'];

    // Encriptar la contraseña antes de guardarla
    //$password_encriptada = password_hash($password, PASSWORD_DEFAULT);
    // Consulta preparada (segura contra SQL Injection)
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password, edad) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $correo, $password, $edad);

    if ($stmt->execute()) {
        echo "<h2>Usuario registrado exitosamente</h2>";
        echo "<a href='formulario.html'>Volver al formulario</a>";
    } else {
        echo "<h2>❌ Error al registrar el usuario:</h2> " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>
