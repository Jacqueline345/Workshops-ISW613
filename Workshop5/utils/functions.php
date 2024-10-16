<?php

/**
 *  Gets the provinces from the database
 */
function getProvinces(): array
{
    // Configura tus credenciales de base de datos
    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "workshop3";

    // Crea la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Comprueba la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Realiza la consulta
    $sql = "SELECT id, nombre FROM provincias"; // Ajusta los nombres de los campos y la tabla según tu base de datos
    $result = $conn->query($sql);

    // Inicializa el array
    $provinces = [];

    // Si hay resultados, los agrega al array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $provinces[$row['id']] = $row['nombre'];
        }
    }

    // Cierra la conexión
    $conn->close();

    // Devuelve el array de provincias
    return $provinces;
}
function getConnection(): bool|mysqli
{
    $connection = mysqli_connect('localhost:3306', 'root', '123456', 'workshop3');
    return $connection;
}

/**
 * Saves an specific user into the database
 */
function saveUser($user): bool
{

    $firstName = $user['firstName'];
    $lastName = $user['lastName'];
    $username = $user['email'];
    $opcionSeleccionada = $_POST['province'];
    $password = md5($user['password']);

    $sql = "INSERT INTO users (name, lastname, username, province, password) VALUES('$firstName', '$lastName', '$username','$opcionSeleccionada','$password')";

    try {
        $conn = getConnection();
        mysqli_query($conn, $sql);
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
    return true;
}

/**
 * Get one specific student from the database
 *
 * @id Id of the student
 */
function authenticate($username, $password): bool|array|null
{
    $conn = getConnection();
    $password = md5($password);
    $sql = "SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password' AND `status` = 'active'";
    $result = $conn->query($sql);

    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $results = $result->fetch_array(MYSQLI_ASSOC);
    if ($results) {
        $id = $results['id'];
        $sql = "UPDATE users SET last_login_datetime = NOW() WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    return $results;
    $stmt->close();
    $conn->close();

}
?>