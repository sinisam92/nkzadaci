<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//zadatak1
class BankAccount
{
    protected $trenutnoStanje = 0;
    protected $blok;


    public function __construct($trenutnoStanje, $blok)
    {

        $this->trenutnoStanje = $trenutnoStanje;
        $this->blok = $blok;

    }
    public function blokadaRacuna()
    {
        if($trenutnoStanje < -200)
        {
            echo 'Uplatite na racun';
        }
    }
    public function podigniNovac($iznos)
    {
         if($iznos > $this->trenutnoStanje)
         die('Nemate dovoljno sredstava na racunu');

         $this->trenutnoStanje -= $iznos;
    }
    public function uplata($iznos)
    {
        $this->trenutnoStanje += $iznos;
    }

}
class User
{
    protected $ime;
    protected $prezime;

    public function __construct($ime ,$prezime)
    {

        $this->ime = $ime;
        $this->prezime = $prezime;

    }
    public function uplati($iznos)
    {
        $this->banka->uplata($iznos);
    }

}

$racun = new BankAccount($trenutnoStanje,$blok);
var_dump($racun);

$user1 = new User('Sinisa', 'Manojlovic');

var_dump($user1);
