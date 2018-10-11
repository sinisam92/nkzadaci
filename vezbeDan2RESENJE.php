<?php
interface Loanable {
    public function loan();
    public function returnFromLoan();
}

abstract class Product {
    protected $serialNumber;
    protected $manufacturer;
    protected $model;
    protected $price;
    protected $numberInStock;

    public function __construct($serialNumber, $manufacturer, $model, $price) {
        $this->serialNumber = $serialNumber;
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->price = $price;
        $this->numberInStock = 0;
    }

    public function getNumberInStock() {
        return $this->numberInStock;
    }

    public function setNumberInStock($numberInStock) {
        $this->numberInStock = $numberInStock;
    }

    public function getModel() {
        return $this->model;
    }

    public function getPrice() {
        return $this->price;
    }
}

class RAM extends Product implements Loanable {
    private $capacity;
    private $clock;

    public function __construct($serialNumber, $manufacturer, $model, $price, $capacity, $clock) {
        parent::__construct($serialNumber, $manufacturer, $model, $price);

        $this->capacity = $capacity;
        $this->clock = $clock;
    }

    public function loan() {
        $this->numberInStock--;
    }

    public function returnFromLoan() {
        $this->numberInStock++;
    }
}

class CPU extends Product {
    private $numberOfCores;
    private $clock;

    public function __construct($serialNumber, $manufacturer, $model, $price, $numberOfCores, $clock) {
        parent::__construct($serialNumber, $manufacturer, $model, $price);

        $this->numberOfCores = $numberOfCores;
        $this->clock = $clock;
    }
}

class GPU extends Product {}

class ComputerShop {
    private $products;
    private $balance;

    public function __construct() {
        $this->products = [];
        $this->balance = 0;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function getProducts() {
        return $this->products;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function sellProduct(Product $product) {
        if (!in_array($product, $this->products)) {
            echo 'We do not sell this product.<br>';
            return;
        }

        if ($product->getNumberInStock() == 0) {
            echo 'This product is currently not in stock.<br>';
            return;
        }

        $this->balance += $product->getPrice();
        $currentNumberInStock = $product->getNumberInStock();
        $product->setNumberInStock($currentNumberInStock - 1);

        echo 'Successfully sold ' . $product->getModel() . '.<br>';
    }

    public function loanProduct(Product $product) {
        if (!($product instanceof Loanable)) {
            echo 'This product is not for loan.<br>';
            return;
        }

        $product->loan();
        $loanCharge = $product->getPrice() * 0.25;
        $this->balance += $loanCharge;

        echo 'Succesfully loaned ' . $product->getModel() . ' for ' . $loanCharge . '.<br>';
    }
}

$ram = new RAM('A00001', 'Kingston', 'SuperSomething', 400, '4GB', 1600);
$ram->setNumberInStock(3);

$cpu = new CPU('A00002', 'Intel', 'Core i5', 600, 2, 2700);
$cpu->setNumberInStock(2);

$gpu = new GPU('A00003', 'Nvidia', 'Something', 123);

$computerShop = new ComputerShop();
$computerShop->addProduct($ram);
$computerShop->addProduct($cpu);

$computerShop->sellProduct($gpu);

$computerShop->sellProduct($ram);
$computerShop->sellProduct($ram);
$computerShop->sellProduct($ram);
$computerShop->sellProduct($ram);
$computerShop->sellProduct($ram);

$computerShop->sellProduct($cpu);
$computerShop->sellProduct($cpu);
$computerShop->sellProduct($cpu);

echo 'Current balance: ' . $computerShop->getBalance() . '.<br>';

$computerShop->loanProduct($ram);
$computerShop->loanProduct($cpu);

echo 'Current balance: ' . $computerShop->getBalance() . '.<br>';