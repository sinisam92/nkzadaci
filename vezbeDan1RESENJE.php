<?php
class BankAccount {
    protected $balance;
    protected $isBlocked;

    public function __construct() {
        $this->balance = 0;
        $this->isBlocked = false;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function isBlocked() {
        return $this->isBlocked;
    }
}

class SimpleBankAccount extends BankAccount {
    public function deposit($amount) {
        $this->balance += $amount;
        echo 'Deposited ' . $amount . ' to simple bank account.<br>';

        if ($this->isBlocked && $this->balance >= 0) {
            $this->isBlocked = false;
            echo 'Simple bank account unblocked.<br>';
        }
    }

    public function withdraw($amount) {
        if ($this->isBlocked) {
            echo 'This simple bank account is blocked, cannot withdraw funds.<br>';
            return;
        }

        $this->balance -= $amount;
        echo 'Withdrew ' . $amount . ' from simple bank account.<br>';

        if ($this->balance <= -200) {
            echo 'Simple bank account is now blocked.<br>';
            $this->isBlocked = true;
        }
    }
}

class SecuredBankAccount extends BankAccount {
    public function deposit($amount) {
        $actualAmount = $amount - $amount * 0.025;

        $this->balance += $actualAmount;
        echo 'Deposited ' . $actualAmount . ' to secured bank account.<br>';

        if ($this->isBlocked && $this->balance >= 0) {
            $this->isBlocked = false;
            echo 'Secured bank account unblocked.<br>';
        }
    }

    public function withdraw($amount) {
        if ($this->isBlocked) {
            echo 'This secured bank account is blocked, cannot withdraw funds.<br>';
            return;
        }

        $actualAmount = $amount - $amount * 0.025;

        $this->balance -= $actualAmount;
        echo 'Withdrew ' . $actualAmount . ' from secured bank account.<br>';

        if ($this->balance <= -1000) {
            echo 'Secured bank account is now blocked.<br>';
            $this->isBlocked = true;
        }
    }
}

class User {
    public $firstName;
    public $lastName;
    private $simpleBankAccount;
    private $securedBankAccount;

    public function __construct(string $firstName, string $lastName) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->simpleBankAccount = new SimpleBankAccount();
        $this->securedBankAccount = new SecuredBankAccount();
    }

    public function depositMoneyToSimpleBankAccount($amount) {
        $this->simpleBankAccount->deposit($amount);
    }

    public function withdrawMoneyFromSimpleBankAccount($amount) {
        $this->simpleBankAccount->withdraw($amount);
    }

    public function echoSimpleBankAccountBalance() {
        echo 'Current balance (simple bank account): ' . $this->simpleBankAccount->getBalance() . '.<br>';
    }

    public function depositMoneyToSecuredBankAccount($amount) {
        $this->securedBankAccount->deposit($amount);
    }

    public function withdrawMoneyFromSecuredBankAccount($amount) {
        $this->securedBankAccount->withdraw($amount);
    }

    public function echoSecuredBankAccountBalance() {
        echo 'Current balance (secured bank account): ' . $this->securedBankAccount->getBalance() . '.<br>';
    }
}

$user = new User('Petar', 'Petrovic');
$user->depositMoneyToSimpleBankAccount(400);
$user->echoSimpleBankAccountBalance();
$user->withdrawMoneyFromSimpleBankAccount(500);
$user->echoSimpleBankAccountBalance();
$user->withdrawMoneyFromSimpleBankAccount(200);
$user->echoSimpleBankAccountBalance();
$user->withdrawMoneyFromSimpleBankAccount(100);
$user->depositMoneyToSimpleBankAccount(1000);

echo '<br>';

$user->depositMoneyToSecuredBankAccount(400);
$user->echoSecuredBankAccountBalance();
$user->withdrawMoneyFromSecuredBankAccount(500);
$user->echoSecuredBankAccountBalance();
$user->withdrawMoneyFromSecuredBankAccount(200);
$user->echoSecuredBankAccountBalance();
$user->withdrawMoneyFromSecuredBankAccount(100);
$user->depositMoneyToSecuredBankAccount(1000);
