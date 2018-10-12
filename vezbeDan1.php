<?php

class BankAccount
{
    protected $stanje;
    protected $blokada;

    public function __construct()
    {
        $this->stanje = 0;
        $this->blokiran = false;
    }

    public function getStanje()
    {
        return $this->stanje;
    }
    public function getBlokada()
    {
        return $this->blokada;
    }
}
class SimpleBankAccount extends BankAccount
{
    public function depozit($iznos)
    {
        $this->stanje += $iznos;
        echo 'Na Simple bank racun je uplaceno ' . $iznos . ' . Stanje na Simple bank racunu je ' . $this->stanje . ' !<br>';

        if ($this->blokada && $this->stanje >= 0)
        {
            $this->blokada = false;
            echo 'Ovaj Simple bank racun je odblokiran!';
        }
    }
    public function isplata($iznos)
    {
        if ($this->blokada)
        {
            echo 'Ovaj Simple bank racun je blokiran zbog nedostatka sredstava.<br>';
            return;
        
        }
        $this->stanje -= $iznos;
        echo 'Sa Simple bank racuna je skinuto ' . $iznos . ' . Stanje na racunu je ' . $this->stanje . ' !<br>';

    if ($this->stanje <= -200)
    {
        echo 'Ovaj Simple bank racun je blokiran. Uplatite sredstva na Simple racun!<br>';
        $this->blokada = true;
    }


    }

}
class SecuredBankAccount extends BankAccount
{
    public function depozit($iznos)
    {
        $pravoStanje = $iznos - $iznos * 0.025;
        $this->stanje += $pravoStanje;
        echo 'Na Secured bank racun je uplaceno ' . $pravoStanje. ' . Stanje na Secured bank racunu je ' . $this->stanje . ' !<br>';

        if ($this->blokada && $this->stanje >= 0)
        {
            $this->blokada = false;
            echo 'Ovaj Secured bank racun je odblokiran!';
        }
    }
    public function isplata($iznos)
    {
        if ($this->blokada)
        {
            echo 'Ovaj Secured bank racun je blokiran zbog nedostatka sredstava.<br>';
            return;
        
        }
        $pravoStanje = $iznos - $iznos * 0.025;
        $this->stanje -= $pravoStanje;
        echo 'Sa Secured bank racuna je skinuto ' . $pravoStanje . ' . Stanje na Secured racunu je ' . $this->stanje . ' !<br>';

    if ($this->stanje <= -1000)
    {
        echo 'Ovaj Secured bank racun je blokiran. Uplatite sredstva na racun!<br>';
        $this->blokada = true;
    }


    }

}
class User
{
    public $ime;
    public $prezime;
    private $simpleBankAccount;
    private $securedBankAccount;

    public function __construct( $ime,  $prezime)
    {
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->simpleBankAccount = new SimpleBankAccount();
        $this->securedBankAccount = new SecuredBankAccount();
        
    }
    public function depositToSimpleBankAccount($iznos)
    {
        $this->simpleBankAccount->depozit($iznos);
    }
    public function isplataFromSimpleBankAccount($iznos)
    {
        $this->simpleBankAccount->isplata($iznos);
    }
    public function depositToSecuredBankAccount($iznos)
    {
        $this->securedBankAccount->depozit($iznos);
    }
    public function isplataFromSecuredBankAccount($iznos)
    {
        $this->securedBankAccount->isplata($iznos);
    }
}

$user = new User('Sinisa', 'Manojlovic');
$user->depositToSimpleBankAccount(500);
$user->depositToSimpleBankAccount(1400);
$user->isplataFromSimpleBankAccount(600);

echo '<br>';

$user->depositToSecuredBankAccount(600);
$user->depositToSecuredBankAccount(400);

$user->isplataFromSecuredBankAccount(600);
$user->isplataFromSecuredBankAccount(600);
$user->isplataFromSecuredBankAccount(600);
$user->isplataFromSecuredBankAccount(600);
$user->isplataFromSecuredBankAccount(600);


