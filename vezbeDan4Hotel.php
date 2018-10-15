<?php

abstract class Soba
{
    protected $brojSobe;
    protected $kupatilo;
    protected $balkon;
    protected $slobodna;
    protected function __construct(int $brojSobe, bool $kupatilo, bool $balkon)
    {
        $this->brojSobe = $brojSobe;
        $this->kupatilo = $kupatilo;
        $this->balkon = $balkon;
        $this->slobodna = true;
    }
    public function getBrojSobe()
    {
        return $this->brojSobe;
    }
    public function isAvailable()
    {
        return $this->slobodna;
    }
    public function iznajmi()
    {
        $this->slobodna = false;
    }
    public function slobodnaSoba()
    {
        $this->slobodna = true;
    }
}
class Jednokrevetna extends Soba
{
   public function __construct(int $brojSobe, bool $kupatilo, bool $balkon)
   {
       parent::__construct($brojSobe, $kupatilo, $balkon);
   }
}
class Dvokrevetna extends Soba
{
    public function __construct(int $brojSobe,  bool $kupatilo,bool $balkon)
    {
        parent::__construct($brojSobe, $kupatilo, $balkon);
    }
}
class Trokrevetna extends Soba
{
    public function __construct(int $brojSobe, bool $kupatilo,bool $balkon)
   {
       parent::__construct($brojSobe, $kupatilo, $balkon);  
   }
}
class Hotel
{
    private $sveSobe;
    private $slobodneSobe;
    private $subscribers;
    public function __construct()
    {
		$this->sveSobe = [];
		$this->slobodneSobe = [
			'Jednokrevetna' => 0,
			'Dvokrevetna' => 0,
			'Trokrevetna' => 0
        ];
        $this->subscribers = [];
    }
        public function dodajSobu(Soba $soba)
        {
            $this->sveSobe[$soba->getBrojSobe()] = $soba;
            $this->slobodneSobe[get_class($soba)]++;
        
         }
    function iznajmiSobu($type)
    {
        if ($this->slobodneSobe[$type] == 0) 
        {
            echo 'Nema soba tipa ' . $type . '<br>';
            return;
        }
        foreach ($this->sveSobe as $soba) 
        {
            if ($soba->isAvailable() && $soba instanceof $type) 
            {
                $soba->iznajmi();
                $this->slobodneSobe[$type]--;
                return;
            }
        }
    }
    public function returnRoom($brojKljuca)
    {
        $soba = $this->sveSobe[$brojKljuca];
        $soba->slobodnaSoba();
        $this->slobodneSobe[get_class($soba)]++;
    }
    public function regSubscriber($subscriber)
    {
        $this->subscribers[] = $subscriber;
    }
    public function notifySubscribers($messagge, $type)
    {
     
        foreach ($this->subscribers as $subscriber) 
        {
            if($this->slobodneSobe[$type] > 0)
            {
                $subscriber->notify($messagge);
            }
        }
    }
}
class User
{
    private $ime;
    private $prezime;
    private $jmbg;

    public function __construct(string $ime, string $prezime, int $jmbg)
    {
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->jmbg = $jmbg;
    }
    public function notify($messagge)
    {
        
        echo 'New message: Za G-dina '. $this->ime . ' ' . $this->prezime . ' ' . $messagge . '<br>';
            
    }
}
    $jednokrevetna = new Jednokrevetna(2, true, false);
    $jednokrevetna2 = new Jednokrevetna(13, true, true);
    $jednokrevetna3 = new Jednokrevetna(17, true, true);
    
    
    
    $dvokrevetna = new Dvokrevetna(4, true, false);
    $dvokrevetna2 = new Dvokrevetna(14, true, true);
    $dvokrevetna3 = new Dvokrevetna(21, true, true);
    
    
    $trokrevetna = new Trokrevetna(7, true, false);
    $trokrevetna2 = new Trokrevetna(15, true, true);
    $trokrevetna3 = new Trokrevetna(23, true, true);
    
    $hotel = new Hotel();
    $hotel->dodajSobu($jednokrevetna);
    $hotel->dodajSobu($jednokrevetna2);
    $hotel->dodajSobu($jednokrevetna3);
    
    $hotel->dodajSobu($dvokrevetna);
    $hotel->dodajSobu($dvokrevetna2);
    $hotel->dodajSobu($dvokrevetna3);
    
    $hotel->dodajSobu($trokrevetna);
    $hotel->dodajSobu($trokrevetna2);
    $hotel->dodajSobu($trokrevetna3);
    
    $hotel->iznajmiSobu('Jednokrevetna');
    $hotel->iznajmiSobu('Jednokrevetna');
    $hotel->iznajmiSobu('Jednokrevetna');
    


    $hotel->iznajmiSobu('Dvokrevetna');
    $hotel->iznajmiSobu('Dvokrevetna');
    $hotel->iznajmiSobu('Dvokrevetna');
    $hotel->iznajmiSobu('Dvokrevetna');
    $hotel->iznajmiSobu('Dvokrevetna');
    


    $hotel->iznajmiSobu('Trokrevetna');
    $hotel->iznajmiSobu('Trokrevetna');
    $hotel->iznajmiSobu('Trokrevetna');
    


    $hotel->returnRoom(2);

    

    $sinisa = new User('Sinisa', 'Manojlovic', 12345151231);
    
    

    $hotel->regSubscriber($sinisa);
    $hotel->notifySubscribers('Vasa soba je spremna, dodjite po kljuc na recepciju!', 'Jednokrevetna');
    echo "<pre>";
    var_dump($hotel);
    echo "</pre>";
