<?php
session_start();
require '../base de datos/conexion.php';

function register() {
    global $mysqli;
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $age = $_POST['age'] ?? '';
    $active = $_POST['active'] ?? '';
    $grado = $_POST['grado'] ?? '';

    if ($name && $email && $password && $age && $active && $grado) {
        // Verificar si el correo ya está registrado
        $stmt = $mysqli->prepare("SELECT id FROM alumnos WHERE correo = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo json_encode(['error' => 'Correo ya registrado']);
        } else {
            // No se usa hash para la contraseña
            $stmt = $mysqli->prepare("INSERT INTO alumnos (nombre, correo, matricula, edad, activo, id_grado) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiiii", $name, $email, $password, $age, $active, $grado);

            if ($stmt->execute()) {
                echo json_encode(['success' => 'Registro exitoso']);
            } else {
                echo json_encode(['error' => 'Error al registrar']);
            }
        }
    } else {
        echo json_encode(['error' => 'Error: Todos los campos son obligatorios']);
    }
}

function login() {
    global $mysqli;
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $stmt = $mysqli->prepare("SELECT id, matricula FROM alumnos WHERE correo = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $stored_password);
            $stmt->fetch();

            // Comparar la contraseña directamente
            if ($password === $stored_password) {
                if ($id === 208) {
                    $_SESSION['role'] = 'admin';
                } else {
                    $_SESSION['role'] = 'user';
                }
                $_SESSION['user_id'] = $id;
                echo json_encode(['success' => 'Inicio de sesión exitoso']);
            } else {
                echo json_encode(['error' => 'Contraseña incorrecta']);
            }
        } else {
            echo json_encode(['error' => 'Correo no registrado']);
        }
    } else {
        echo json_encode(['error' => 'Error: Todos los campos son obligatorios']);
    }
}   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    try {
        if (isset($_POST['register'])) {
            register();
        } else if (isset($_POST['login'])) {
            login();
        } else {
            echo json_encode(['error' => 'Acción no válida']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error inesperado: ' . $e->getMessage()]);
    }
}
?>