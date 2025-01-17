<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'bdpruebas';
$username = 'root';
$password = '';

try {
    // Crear una instancia de PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos.\n";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

function createProduct($name, $price) {
    global $pdo;
    $sql = "INSERT INTO products (name, price) VALUES (:name, :price)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'price' => $price]);
    return $pdo->lastInsertId(); // Retorna el ID del nuevo producto
}

function getAllProducts() {
    global $pdo;
    $sql = "SELECT * FROM products";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los productos
}

function updateProductPrice($id, $newPrice) {
    global $pdo;
    $sql = "UPDATE products SET price = :price WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id, 'price' => $newPrice]);
    return $stmt->rowCount(); // Retorna el número de filas afectadas
}

function deleteProduct($id) {
    global $pdo;
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->rowCount(); // Retorna el número de filas afectadas
}




// Ejemplo de uso
$products = getAllProducts();
echo json_encode($products, JSON_PRETTY_PRINT);

// Ejemplo de uso
$newProductId = createProduct('Laptop', 1200.50);
echo "Nuevo producto creado con ID: $newProductId\n";

// Ejemplo de uso
$rowsUpdated = updateProductPrice(1, 1300.00);
echo "Filas actualizadas: $rowsUpdated\n";

// Ejemplo de uso
$rowsDeleted = deleteProduct(1);
echo "Filas eliminadas: $rowsDeleted\n";

?>

