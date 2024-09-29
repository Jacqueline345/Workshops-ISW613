<?php
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
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table class='table'>";
    echo "<thead><tr><th> Nombre </th> <th> Apellido </th> <th> Correo electronico </th> <th> Provincia </th></tr></thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td>" . htmlspecialchars($row['province']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No hay usuarios registrados.";
}

// Cerrar conexión
mysqli_close($conn);
?>
