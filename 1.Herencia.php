<?php
class Animal{

    public function speak(){
        echo 'El animal hace un sonido';
    }
}

class Dog extends Animal{

    public function speak(){
        echo 'Guau guau';
    }
}