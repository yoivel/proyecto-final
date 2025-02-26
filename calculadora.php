<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "energy_db";

// Conectar con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$power = $_POST['power'];
$hours = $_POST['hours'];
$rate = $_POST['rate'];
$energyConsumed = ($power * $hours) / 1000;
$cost = $energyConsumed * $rate;

// Insertar en la base de datos
$sql = "INSERT INTO energy_records (power, hours, rate, energy_consumed, cost) 
        VALUES ('$power', '$hours', '$rate', '$energyConsumed', '$cost')";

if ($conn->query($sql) === TRUE) {
    echo "Registro guardado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "energy_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM energy_records ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Cálculos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Historial de Consumo Energético</h1>
    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Potencia (W)</th>
            <th>Horas</th>
            <th>Tarifa ($/kWh)</th>
            <th>Consumo (kWh)</th>
            <th>Costo ($)</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["date"] ?></td>
            <td><?= $row["power"] ?></td>
            <td><?= $row["hours"] ?></td>
            <td><?= $row["rate"] ?></td>
            <td><?= $row["energy_consumed"] ?></td>
            <td><?= $row["cost"] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "energy_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT date, energy_consumed, cost FROM energy_records ORDER BY date ASC";
$result = $conn->query($sql);

$dates = [];
$energy = [];
$costs = [];

while ($row = $result->fetch_assoc()) {
    $dates[] = $row["date"];
    $energy[] = $row["energy_consumed"];
    $costs[] = $row["cost"];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos de Consumo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Consumo Energético y Costo</h1>
    <canvas id="energyChart"></canvas>

    <script>
        let ctx = document.getElementById("energyChart").getContext("2d");
        let chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: <?= json_encode($dates) ?>,
                datasets: [
                    {
                        label: "Consumo (kWh)",
                        data: <?= json_encode($energy) ?>,
                        borderColor: "blue",
                        fill: false
                    },
                    {
                        label: "Costo ($)",
                        data: <?= json_encode($costs) ?>,
                        borderColor: "red",
                        fill: false
                    }
                ]
            }
        });
    </script>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "energy_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso. <a href='login.php'>Inicia sesión aquí</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "energy_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}

$conn->close();
?>

[8:11 a.m., 18/2/2025] Angel: <?php
session_start();
if (!isset($_SESSION["username"])) { .00
    header("Location: login.php");
     exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?= $_SESSION["username"] ?></h1>
    <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
[8:11 a.m., 18/2/2025] Angel: <?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?>