<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ProdavnicaRacunara
{
    private $balans;
    protected $artikli = [];

    public function __construct($balans, $artikli)
    {
        $this->balans = 0;
    }
    public function dodajArtikal()
    {

    }
    public function balans()
    {
        $this->balans += $cena;
    }
}
abstract class Artikl
{
    protected $serijskiBroj;
    protected $proizvodjac;
    protected $model;
    protected $cena;
    protected $stanjeNaLageru;

    public function __construct($serijskiBroj, $proizvodjac, $model, $cena, $stanjeNaLageru)
    {
        $this->serijskiBroj = $serijskiBroj;
        $this->proizvodjac = $proizvodjac;
        $this->model = $model;
        $this->cena = $cena;
        $this->stanjeNaLageru = 0;
        
    }

}
class RAM extends Artikl
{
     
    protected $kapacitet;
    protected $frekfencija;

    public function __construct($kapacitet, $frekfencija)
    {
        parent::__construct($serijskiBroj, $proizvodjac, $model, $cena, $stanjeNaLageru);
        $this->kapacitet = $kapacitet;
        $this->frekfencija = $frekfencija;
    }

}
class CPU extends Artikl
{
    protected $brojJezgara;
    protected $frekfencija;

    public function __construct($brojJezgara, $frekfencija)
    {
        parent::__construct($serijskiBroj, $proizvodjac, $model, $cena, $stanjeNaLageru);
        $this->brojJezgara = $brojJezgara;
        $this->frekfencija = $frekfencija;
    }
}
class HDD extends Artikl
{
    protected $kapacitet;

    public function __construct($kapacitet)
    {
        parent::__construct($serijskiBroj, $proizvodjac, $model, $cena, $stanjeNaLageru);
        $this->kapacitet = $kapacitet;
    }
}
class GPU extends Artikl
{
    protected $frekfencija;
    
    public function __construct($frekfencija)
    {
        parent::__construct($serijskiBroj, $proizvodjac, $model, $cena, $stanjeNaLageru);
        $this->frekfencija = $frekfencija;
    }
}

$ram = new RAM('4gb', '2400hz', '0001', 'Kingston','Kingston 1234523', 4500, 15);

var_dump($ram);