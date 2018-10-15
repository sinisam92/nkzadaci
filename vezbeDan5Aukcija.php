<?php

class Korisnik
{
    private $ime;
    private $prezime;

    public function __construct(string $ime, string $prezime)
    {
        $this->ime = $ime;
        $this->prezime = $prezime;
    }
    public function dodajProizvodULIstuZelja()
    {
        $this->
    }
    public function ukloniProizvodIzListeProizvoda()
    {

    }
    public function posaljiPonudu()
    {

    }

    public function povuciPonudu()
    {

    }
    public function prodajProizvod()
    {

    }
}
class Proizvod
{
    protected $vlasnik;
    protected $pocetnaCena;

    public function __construct($vlasnik)
    {
        $this->vlasnik = $vlasnik;
        $this->pocetnaCena = 0;
    }
}

$marko = new Korisnik('Marko', 'Markovic');
$mile = new Korisnik('Mile','Marinkovic');
$djoka = new Korisnik('Djordje','Djordjevic');

$proizvod = new Proizvod($marko);

var_dump($marko, $mile, $djoka, $proizvod);

