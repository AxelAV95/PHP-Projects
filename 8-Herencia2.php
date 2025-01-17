<?php
// Clase base Animal
class Animal {
    // Atributos
    protected $name;
    protected $species;

    // Constructor
    public function __construct($name, $species) {
        $this->name = $name;
        $this->species = $species;
    }

    // Método para obtener detalles del animal
    public function getDetails() {
        return "Nombre: " . $this->name . ", Especie: " . $this->species;
    }

    // Método estático para obtener información del animal
    public static function getAnimalInfo($name, $species) {
        return "Animal: " . $name . " (" . $species . ")";
    }
}

// Clase Lion que hereda de Animal
class Lion extends Animal {
    // Atributo adicional
    private $isKing;

    // Constructor
    public function __construct($name, $species, $isKing = false) {
        parent::__construct($name, $species); // Llama al constructor de la clase base
        
        $this->isKing = $isKing;
    }

    // Método para rugir
    public function roar() {
        if ($this->isKing) {
            echo $this->name . " ruge: ¡ROAR! Soy el Rey del Zoo.\n";
        } else {
            echo $this->name . " ruge: ¡ROAR!\n";
        }
    }
}

// Clase Zookeeper
class Zookeeper {
    // Atributo
    private $name;

    // Constructor
    public function __construct($name) {
        $this->name = $name;
    }

    // Método para alimentar un animal
    public function feedAnimal($animal) {
        return $this->name . " ha alimentado a " . $animal->getDetails() . ".\n";
    }
}

// Ejemplo de uso
$lion = new Lion("Simba", "León", true); // Crear un león que es el Rey
$zookeeper = new Zookeeper("Carlos"); // Crear un cuidador

echo $lion->getDetails() . "\n"; // Mostrar detalles del león
$lion->roar(); // Hacer rugir al león
echo $zookeeper->feedAnimal($lion); // Alimentar al león

// Usar el método estático
echo Animal::getAnimalInfo("Nala", "Leona") . "\n";
?>