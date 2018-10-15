<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


interface Pozajmljivo
{
    public function pozajmica();
    public function vracanjePozajmice();
}
class Prodavnica 
{
    private $balans;
    private $proizvodi;

    public function __construct()
    {
        $this->balans = 0;
        $this->lager = [];
    }
    
    public function dodajProizvod(Proizvod $proizvod)
    {
        $this->proizvodi[] = $proizvod;
    }
    public function getBalans()
    {
        return $this->balans;
    }
    public function getProizvod()
    {
        return $this->proizvodi;
    }
    public function prodajProizvod(Proizvod $proizvod)
    {
        if(!in_array($proizvod, $this->proizvodi))
        {
            echo 'Nemamo ovaj proizvod u nasoj ponudi.<br>';
            return;
        }

        if($proizvod->getStanjeNaLageru() == 0)
        {
            echo 'Trenutno na stanju nemamo ovaj proizvod!<br>';
            return;
        }

        $this->balans += $proizvod->getCenaProizvoda();
        $proizvod->setStanjeNaLageru($proizvod->getStanjeNaLageru() - 1);
        echo 'Successfully sold ' . $proizvod->getModel() . '.<br>';
    }
    public function nePozajmljivo(Proizvod $proizvod)
    {
        if(!($proizvod instanceof Pozajmljivo))
        {
            echo 'Proizvod nije za pozajmljivanje!';
            return;
        }
        $proizvod->pozajmica();
        $cenaPozajmice = $proizvod->getCenaProizvoda() * 0.25;
        $this->blanas += $cenaPozajmice;

        echo 'Succesfully loaned ' . $proizvod->getModel() . ' for ' . $cenaPozajmice . '.<br>';
    }

}
abstract class Proizvod
{
    protected $serijskiBroj;
    protected $proizvodjac;
    protected $model;
    protected $cena;
    protected $stanjeNaLageru;

    public function __construct($serijskiBroj, $proizvodjac, $model, $cena)
    {
        $this->serijskiBroj = $serijskiBroj;
        $this->proizvodjac = $proizvodjac;
        $this->model = $model;
        $this->cena = $cena;
        $this->stanjeNaLageru = 0;
    }
    public function getStanjeNaLageru()
    {
        return $this->stanjeNaLageru;
    }
    public function setStanjeNaLageru($stanjeNaLageru)
    {
        $this->stanjeNaLageru = $stanjeNaLageru ;
    }
    public function getCenaProizvoda()
    {
        return $this->cena;
    }
    public function getModel()
    {
        return $this->model;
    }

}
class RAM extends Proizvod implements Pozajmljivo
{
    private $kapacitet;
    private $frekfencija;

    public function __construct($serijskiBroj, $proizvodjac, $model, $cena, $kapacitet, $frekfencija)
    {
        parent::__construct($serijskiBroj, $proizvodjac, $model, $cena);
        $this->kapacitet = $kapacitet;
        $this->frekfencija = $frekfencija;
    }
    public function pozajmica()
    {
        $this->stanjeNaLageru--;
    }
    public function vracanjePozajmice()
    {
        $this->stanjeNaLageru++;
    }
}
class CPU extends Proizvod
{
    private $brojJezgara;
    private $frekfencija;

    public function __construct($serijskiBroj, $proizvodjac, $model, $cena, $brojJezgara, $frekfencija)
    {
        parent::__construct($serijskiBroj, $proizvodjac, $model, $cena);
        $this->brojJezgara = $brojJezgara;
        $this->frekfencija = $frekfencija;
    }

}
class HDD extends Proizvod
{
    
    private $kapacitet;
    

    public function __construct($serijskiBroj, $proizvodjac, $model, $cena, $kapacitet)
    {
        parent::__construct($serijskiBroj, $proizvodjac, $model, $cena);
        $this->kapacitet = $kapacitet;
       
    }
}
class GPU extends Proizvod
{
   
}

$ram = new RAM('A00001', 'Kingston', 'Kingston 4gb', 400, '4GB', 1600);
$ram->setStanjeNaLageru(3);

$cpu = new CPU('A00002', 'Intel', 'Core i5', 600, 2, 2700);
$cpu->setStanjeNaLageru(2);


$prodavnica = new Prodavnica();
$prodavnica->dodajProizvod($ram);
$prodavnica->dodajProizvod($cpu);
// function dump($x)
// {
//     echo '<pre>';
//     var_dump($x);
//     echo '<pre>';

// }

// dump($prodavnica);

$prodavnica->prodajProizvod($ram);
echo 'Current balance: ' . $prodavnica->getBalans() . '.<br>';
$prodavnica->prodajProizvod($ram);
echo 'Current balance: ' . $prodavnica->getBalans() . '.<br>';
$prodavnica->prodajProizvod($ram);
echo 'Current balance: ' . $prodavnica->getBalans() . '.<br>';
$prodavnica->prodajProizvod($ram);
echo 'Current balance: ' . $prodavnica->getBalans() . '.<br>';
$prodavnica->prodajProizvod($ram);
echo 'Current balance: ' . $prodavnica->getBalans() . '.<br>';

$prodavnica->prodajProizvod($cpu);
echo 'Current balance: ' . $prodavnica->getBalans() . '.<br>';
$prodavnica->prodajProizvod($cpu);
echo 'Current balance: ' . $prodavnica->getBalans() . '.<br>';
$prodavnica->prodajProizvod($cpu);

echo 'Current balance: ' . $prodavnica->getBalans() . '.<br>';

$prodavnica->nePozajmljivo($ram);
$prodavnica->nePozajmljivo($cpu);

echo 'Current balance: ' . $prodavnica->getBalans() . '.<br>';
