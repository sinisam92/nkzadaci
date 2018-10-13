<?php
class InspectionService
{
    private static $instance;
    private $inspectedCount;

    public function __construct()
    {
        $this->inspectedCount = 0;
    }
    static function getInstance() 
    {
        if (self::$instance == NULL) 
        {
            self::$instance = new InspectionService();
        }

        return self::$instance;
    }
    public function getInspectedVehiclecount()
    {
        return $this->inspectedCount;
    }
    public function inspectVehicle(Vehicle $vehicle)
    {
        echo $vehicle->inspect() . '<br>';
        $this->inspectedCount++;
    }
}
interface Vehicle
{
    public function inspect();
}
class Car implements Vehicle
{
    public function inspect()
    {
        echo 'Inspecting Car...';
    }
}
class Bike implements Vehicle
{
    public function inspect()
    {
        echo 'Inspecting Bike...';
    }
}
interface MakeVehicle
{
    public function makeVehicle(): Vehicle;
}
class CarFactory implements MakeVehicle
{
    public function makeVehicle():Vehicle
    {
        return new Car();
    }
}
class BikeFactory implements MakeVehicle
{
    public function makeVehicle():Vehicle
    {
        return new Bike();
    }
}
$carFactory = new CarFactory();
$bikeFactory = new BikeFactory();

$car = $carFactory->makeVehicle();
$bike = $bikeFactory->makeVehicle();

// function dump($x)
// {
//     echo '<pre>';
//     var_dump($x);
//     echo '</pre>';
// }

// dump($car);
// dump($bike);

InspectionService::getInstance()->inspectVehicle($car);
InspectionService::getInstance()->inspectVehicle($bike);
echo 'Inspected vehicle: ' . InspectionService::getInstance()->getInspectedVehiclecount() . '<br>';