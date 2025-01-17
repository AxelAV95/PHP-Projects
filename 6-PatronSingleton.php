<?php

class Logger
{
    // Almacena la única instancia de la clase
    private static $instance = null;

    // Almacena los logs
    private $logs = [];

    // El constructor es privado para evitar la creación de nuevas instancias
    private function __construct() {}

    // Método para obtener la instancia única de la clase
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    // Método para añadir un mensaje al log
    public function addLog($message)
    {
        $this->logs[] = $message;
    }

    // Método para obtener todos los logs
    public function getLogs()
    {
        return $this->logs;
    }

    // Evita la clonación de la instancia
    private function __clone() {}

    // Evita la deserialización de la instancia
    private function __wakeup() {}
}

// Uso del Singleton
$logger = Logger::getInstance();
$logger->addLog("Primer mensaje de log");
$logger->addLog("Segundo mensaje de log");

// Obtener los logs
$logs = $logger->getLogs();
print_r($logs);

// Intentar crear otra instancia (debería ser la misma)
$anotherLogger = Logger::getInstance();
$anotherLogger->addLog("Tercer mensaje de log");

// Verificar que los logs se comparten entre las instancias
$logs = $anotherLogger->getLogs();
print_r($logs);

?>