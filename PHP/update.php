<?php
session_start();
require '../base de datos/conexion.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.html');
    exit();
}

// Fetch user data
$id = $_GET['id'];
$stmt = $mysqli->prepare("SELECT * FROM alumnos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("UPDATE alumnos SET nombre = ?, correo = ?, matricula = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $password, $id);
    $stmt->execute();

    header('Location: ../admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Actualizar Usuario</h1>
        <form method="POST">
            <input type="text" name="name" placeholder="Nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required>
            <input type="email" name="email" placeholder="Correo" value="<?php echo htmlspecialchars($user['correo']); ?>" required>
            <input type="text" name="password" placeholder="Matrícula" value="<?php echo htmlspecialchars($user['matricula']); ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>