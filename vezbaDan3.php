<?php

class MailService
{
   private static $instance;


   static function getInstance()
   {
       if (self::$instance == NULL)
       {
           self::$instance = new MailService();
       }
       return self::$instance;
   }
   public function sendMail($address, $subject, $text)
   {
        
   }
}
class Mail
{
    private $address;
    private $subject;
    private $text;

    public function __construct($address, $subject, $text)
    {
        $this->address = $address;
        $this->subject = $subject;
        $this->text = $text;
    }
    public function getAddress()
    {
        return $this->adrress;

    }
    public function getSubject()
    {
        return $this->subject;

    }
    public function getText()
    {
        return $this->text;

    }
}
class MailFactory
{
    public function makeMail()
    {
       return new Mail();
    }
}

$factory = new MailFactory();
$mail = $factory->makeMail();
