<?php


class Bankomat
{
    private $state = 'ready';

    public function insertCardAndPin()
    {
        if($this->state == 'ready'){
            echo 'Ubacite karticu i ukucajte vas pin...<br>';
            $this->state = 'validate';
        }else {
            echo 'Error!<br>';
        }
   
    }
    public function inputAmountAndConfirm()
    {
        if($this->state == 'validate'){
            echo 'Unesite zeljeni iznos...<br>';
            $this->state = 'isplata';
        }else {
            echo 'Error!<br>';
        }
  
    }
    public function demandCheck()
    {
        if($this->state == 'isplata'){
            echo 'Isplata<br>';
        }else {
            echo 'Error!<br>';
        }
       
       
    }
}

$bankomat = new Bankomat();

$bankomat->insertCardAndPin();
$bankomat->inputAmountAndConfirm();
$bankomat->demandCheck();

