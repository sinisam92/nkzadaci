<?php 

class Person 
{

    private $first;
    private $last;
    public function __construct($first, $last) 
    {
        $this->first = $first;
        $this->last = $last;
    }
}

$marko = new Person ('Marko', 'Markovic');

var_dump($marko);

class Product {
	public static $count = 0;
	public $name;

	public function __construct($productName) {
		self::$count++;
		$this->name = $productName;
		echo "Produced so far: " . self::$count . "<br>";
	}
}

$milk = new Product("Milk");
$bread = new Product("Bread");

echo $milk->name . "<br>";
echo $bread->name . "<br>";
echo "Total number of created products: " . Product::$count . "<br>";



class Animal {
    public $name;
    }
    
    class Dog extends Animal {
    public function bark() {
    echo 'Woof!';
    }
    }
    
    $someAnimal = new Animal();
    $someDog = new Dog();
    
    var_dump($someDog instanceof Dog);  // true
    var_dump($someDog instanceof Animal);  // true
    var_dump($someAnimal instanceof Animal);  // true
    var_dump($someAnimal instanceof Dog);  // false!



class Person1 {
    private $firstname;
    private $lastname;

    public function __construct($firstname, $lastname) {

        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
}
class Student extends Person1 {

    private $jbmg;
    private $index;

    public function __construct($firstname,$lastname,$jbmg, $index)
    {
        parent::__construct($firstname, $lastname);
        $this->jbmg = $jbmg;
        $this->index = $index;
    }
}
    
$student = new Student('Marko', 'Markovic', '12312512512412', 12341);

var_dump($student);