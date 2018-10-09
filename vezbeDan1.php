<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//zadatak1
class BankAccount
{
    protected $stanje = 0;
    protected $blokiran;


    public function __construct()
    {

        $this->stanje = 0;
        $this->blokiran = false;

    }
    public function getStanje()
    {
        return $this->stanje;
    }
    public function getBlokiran()
    {
        return $this->blokiran;
    }

}
class SimpleBankAccount extends BankAccount
{
    public function uplata($iznos)
    {
        $this->stanje += $iznos;
        echo 'Uplaceno ' . $iznos . ' na simple bank racun. </br>';

        if ($this->blokiran && $this->stanje >=0)
        {
            $this->blokiran = false;
            echo 'Racun nije u blokadi! </br>';
        }
    }
    public function isplata($iznos)
    {
        if ($this->blokiran)
        {   
            echo 'Ovaj simple account je blokiran. </br>';
            return;
        }
        $this->stanje -= $iznos;
        echo 'Sa racuna je skinuto ' . $iznos . ' sredstava.</br>';
        
        if ($this->stanje <= -200)
        {
            echo 'Ovaj simple bank account je blokiran!</br>';
            $this->blokiran = true;
        }
    }
}
class SecuredBankAccount extends BankAccount
{
    public function uplata($iznos)
    {
        $trenutnoIznos = $iznos - $iznos * 0.025;
        $this->stanje += $trenutnoIznos;
        echo 'Uplaceno ' . $trenutnoIznos . ' na secured bank racun. </br>';

        if ($this->blokiran && $this->stanje >=0)
        {
            $this->blokiran = false;
            echo 'Racun nije u blokadi! </br>';
        }
    }
    public function isplata($iznos)
    {
        if ($this->blokiran)
        {   
            echo 'Ovaj secured account je blokiran. </br>';
            return;
        }

        $trenutnoIznos = $iznos - $iznos * 0.025;
        $this->stanje -= $trenutnoIznos;
        echo 'Sa secured bank account je skinuto ' . $trenutnoIznos . 'sredstava. </br>';

        if ($this->stanje <= -1000)
        {
            echo 'Ovaj simple bank account je blokiran! </br>';
            $this->blokiran = true;
        }
    
    }
}
class User
{
    protected $ime;
    protected $prezime;
    private $simpleBankAccount;
    private $securedBankAccount;

    public function __construct($ime ,$prezime)
    {

        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->simpleBankAccount = new SimpleBankAccount();
        $this->securedBankAccount = new SecuredBankAccount();

    }
    public function uplataNaSimplebankAccount($iznos)
    {
        $this->simpleBankAccount->uplata($iznos);
    }
    public function isplataSaSimpleBankAccount($iznos)
    {
        $this->simpleBankAccount->isplata($iznos);
    }
    public function trenutnoStanjeNaSimpleBankAccount()
    {
        echo 'Trenutno stanje na simple bank account-u je ' . $this->simpleBankAccount->getStanje() . '!</br>';
    }
    public function uplataNaSecuredbankAccount($iznos)
    {
        $this->securedBankAccount->uplata($iznos);
    }
    public function isplataSaSecuredBankAccount($iznos)
    {
        $this->securedBankAccount->isplata($iznos);
    }
    public function trenutnoStanjeNaSecuredBankAccount()
    {
        echo 'Trenutno stanje na secured bank account-u je ' . $this->securedBankAccount->getStanje() . '!</br>';
    }


}

$user = new User('Sinisa', 'Manojlovic');

$user->uplataNaSimplebankAccount(400);
$user->trenutnoStanjeNaSimpleBankAccount();
$user->isplataSaSimpleBankAccount(500);
$user->trenutnoStanjeNaSimpleBankAccount();
$user->isplataSaSimpleBankAccount(200);
$user->trenutnoStanjeNaSimpleBankAccount();
$user->isplataSaSimpleBankAccount(100);
$user->uplataNaSimplebankAccount(1000);

echo '<br>';

$user->uplataNaSecuredbankAccount(400);
$user->trenutnoStanjeNaSecuredBankAccount();
$user->isplataSaSecuredBankAccount(500);
$user->trenutnoStanjeNaSecuredBankAccount();
$user->isplataSaSecuredBankAccount(200);
$user->trenutnoStanjeNaSecuredBankAccount();
$user->isplataSaSecuredBankAccount(100);
$user->uplataNaSecuredbankAccount(1000);


