<?php
session_start();
session_destroy();
header("Location: login.php"); // Redirigir al inicio de sesión después de cerrar la sesión
?>