<?php 

class Car{
    private $make;
    private $model;
    private $year;

    public function __construct($make, $model, $year){
        $this->make=$make;
        $this->model=$model;
        $this->year=$year;
    }

    public function displayInfo(){
        echo "Marca: " . $this->make . "\n";
        echo "Modelo: " . $this->model . "\n";
        echo "Año: " . $this->year . "\n";
    }

    public static function getCarInfo($make, $model, $year){
        return "Marca: " . $make . ", Modelo: " . $model. ', Año: ' . $year;
    }
}

$miCarro = new Car('Toyota','Corolla',2008);
$miCarro->displayInfo();

echo $miCarro::getCarInfo('Honda','Civic',2014);

?>