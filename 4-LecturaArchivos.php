<?php
// Nombre del archivo
$filename = 'data.txt';

// Verificar si el archivo existe
if (!file_exists($filename)) {
    die("El archivo $filename no existe.");
}

// Abrir el archivo en modo lectura
$file = fopen($filename, 'r');

// Arreglo para almacenar los registros
$registros = [];

// Leer el archivo línea por línea
while (($line = fgets($file)) !== false) {
    // Eliminar espacios en blanco al inicio y final de la línea
    $line = trim($line);

    // Ignorar líneas vacías
    if (empty($line)) {
        continue;
    }

    // Dividir la línea en partes usando la coma como separador
    $datos = explode(',', $line);

    // Verificar que la línea tenga exactamente 3 campos
    if (count($datos) === 3) {
        // Crear un arreglo asociativo con los datos
        $registro = [
            'name' => trim($datos[0]),
            'age' => trim($datos[1]),
            'email' => trim($datos[2]),
        ];

        // Agregar el registro al arreglo de registros
        $registros[] = $registro;
    }
}

// Cerrar el archivo
fclose($file);

// Mostrar los datos en una tabla HTML
echo "<html>
<head>
    <title>Registros de data.txt</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style='text-align: center;'>Registros de data.txt</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Email</th>
        </tr>";

// Recorrer los registros y mostrarlos en la tabla
foreach ($registros as $registro) {
    echo "<tr>
            <td>{$registro['name']}</td>
            <td>{$registro['age']}</td>
            <td>{$registro['email']}</td>
          </tr>";
}

echo "</table>
</body>
</html>";
?>