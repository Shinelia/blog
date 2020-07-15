<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\Temperature;

class TemperatureTest extends TestCase
{
    private $temperature; //on cree une variable privée et on crée son constructeur en tant qu'objet Temperature 
                        // afin de l'utiliser dans les méthodes suivantes

    public function __construct()
    {
        parent::__construct(); //const classe parent car extends TestCase
        $this->temperature = new Temperature();
    }


    public function testTemperatureIsNumeric()
    {
        for($i = 0; $i < 100; $i++){
            $degrees = $this->temperature->getTemperature();
            $this->assertIsNumeric($degrees);
        }
    }

    public function testTemperatureIsBetweenLimits()
    {
        for($i = 0; $i < 100; $i++){
            $degrees = $this->temperature->getTemperature();
            
            $this->assertGreaterThanOrEqual(15,$degrees);
            $this->assertLessThanOrEqual(25,$degrees);
        }
    }

}
