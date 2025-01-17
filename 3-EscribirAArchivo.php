<?php
function writeToFile($filename, $content) {
    // Abre el archivo en modo escritura (si no existe, lo crea; si existe, lo sobrescribe)
    $file = fopen($filename, "w");

    // Verifica si el archivo se abrió correctamente
    if ($file === false) {
        return "Error: No se pudo abrir el archivo.";
    }

    // Escribe el contenido en el archivo
    fwrite($file, $content);

    // Cierra el archivo
    fclose($file);

    return "Contenido escrito correctamente en el archivo.";
}

// Ejemplo de uso
$filename = "example.txt";
$content = "¡Hola, mundo! Este es un archivo de prueba.";
$result = writeToFile($filename, $content);

echo $result;
?>