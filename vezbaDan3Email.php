<?php

class MailService
{
   private static $instance;
   private $sentEmailCount;

   private function __construct()
   {
       $this->sentEmailCount = 0;
   }

   static function getInstance()
   {
       if (self::$instance == NULL)
       {
           self::$instance = new MailService();
       }
       return self::$instance;
   }
   public function sendEmail(Email $email)
   {
        echo 'Sending email to: ' . $email->getAddress() . '<br>';

        $this->sentEmailCount++;
   }
}
class Email
{
    private $address;
    private $subject;
    private $text;

    public function __construct(string $address, string $subject, string $text)
    {
        $this->address = $address;
        $this->subject = $subject;
        $this->text = $text;
    }
    public function getAddress()
    {
        return $this->address;

    }
}
class EmailFactory
{
    public function createEmail(string $address, string $subject, string $text)
    {
       return new Email($address, $subject, $text);
    }
}

$factory = new EmailFactory();
$regEmail = $factory->createEmail('sinisa@net.com', 'Validation', '123123411231 type the numbers in your valdation field');
$subEmail = $factory->createEmail('milan@net.com', 'Registration', '12341241231231452 type the numbers in your valdation field');


MailService::getInstance()->sendEmail($regEmail);
MailService::getInstance()->sendEmail($subEmail);
echo 'Sent emails: ' . MailService::getInstance()->sentEmailCount();

